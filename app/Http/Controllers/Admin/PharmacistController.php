<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pharmacist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;

class PharmacistController extends Controller
{
    public function index(Request $request)
    {
        $query = Pharmacist::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pharmacists = $query->orderBy('first_name')->paginate(10)->withQueryString();

        $cards = [
            [
                'icon' => 'bi-people-fill',
                'title' => 'Total Pharmacists',
                'value' => Pharmacist::count(),
                'color' => 'text-primary'
            ],
            [
                'icon' => 'bi-person-check',
                'title' => 'Active Pharmacists',
                'value' => Pharmacist::where('status', true)->count(),
                'color' => 'text-success'
            ],
            [
                'icon' => 'bi-person-x',
                'title' => 'Inactive Pharmacists',
                'value' => Pharmacist::where('status', false)->count(),
                'color' => 'text-danger'
            ],
        ];
    
        return view('admin.pages.pharmacists.index', compact('pharmacists', 'cards'));
    }
    

    public function create()
    {
        return view('admin.pages.pharmacists.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name'      => 'required|string',
            'last_name'       => 'required|string',
            'email'           => 'required|email|unique:pharmacists,email',
            'password'        => 'required|min:6',
            'profile_photo'   => 'nullable|image|max:2048',
            'date_of_birth'   => 'nullable|date',
            'license_number'  => 'nullable|string',
        ]);
    
        $data = $request->only([
            'first_name',
            'last_name',
            'email',
            'phone',
            'gender',
            'date_of_birth',
            'address',
            'license_number',
            'status',
        ]);
    
        $data['password'] = Hash::make($request->password);
    
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/pharmacists'), $filename);
            $data['profile_photo'] = 'images/pharmacists/' . $filename;
        }
    
        Pharmacist::create($data);
    
        return redirect()->route('admin.pharmacists.index')
            ->with('success', 'Pharmacist created successfully.');
    }    
    
    public function toggleStatus($id)
    {
        $pharmacist = Pharmacist::findOrFail($id);
        $pharmacist->status = !$pharmacist->status;
        $pharmacist->save();

        return redirect()->route('admin.pharmacists.index')
            ->with('success', "Pharmacist {$pharmacist->full_name} status updated successfully.");
    }

    public function update(Request $request, $id)
    {
        $pharmacist = Pharmacist::findOrFail($id);

        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:pharmacists,email,' . $id,
            'phone' => 'nullable',
            'gender' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable|string',
            'license_number' => 'nullable|string',
            'profile_photo' => 'nullable|image|max:2048',
        ]);

        $data = $request->only([
            'first_name', 'last_name', 'email', 'phone', 
            'gender', 'date_of_birth', 'address', 'license_number',
        ]);

        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/pharmacists'), $filename);
            $data['profile_photo'] = 'images/pharmacists/' . $filename;
        }

        $pharmacist->update($data);

        return redirect()->route('admin.pharmacists.index')
            ->with('success', 'Pharmacist updated successfully.');
    }

    public function exportCsv(Request $request)
    {
        $pharmacists = Pharmacist::orderBy('first_name')->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="pharmacists.csv"',
        ];

        $columns = [
            'First Name',
            'Last Name',
            'Email',
            'Phone',
            'Gender',
            'Date of Birth',
            'Address',
            'License Number',
            'Status',
            'Profile Photo'
        ];

        $callback = function() use ($pharmacists, $columns) {
            $file = fopen('php://output', 'w');

            fputcsv($file, $columns);

            foreach ($pharmacists as $ph) {
                fputcsv($file, [
                    $ph->first_name,
                    $ph->last_name,
                    $ph->email,
                    $ph->phone ?? '',
                    ucfirst($ph->gender ?? ''),
                    $ph->date_of_birth?->format('Y-m-d') ?? '',
                    $ph->address ?? '',
                    $ph->license_number ?? '',
                    $ph->status ? 'Active' : 'Inactive',
                    $ph->profile_photo ?? '',
                ]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    public function exportPdf()
    {
        $pharmacists = Pharmacist::orderBy('first_name')->get();
        $pdf = Pdf::loadView('admin.pages.pharmacists.pdf', compact('pharmacists'));
        return $pdf->download('pharmacists.pdf');
    }
}
