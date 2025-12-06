<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cashier;
use Barryvdh\DomPDF\Facade\Pdf;

class CashierController extends Controller
{
    public function index(Request $request)
    {
        $query = Cashier::query();
    
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }
    
        $cashiers = $query->orderBy('created_at', 'desc')->paginate(10);
    
        $cards = [
            ['title'=>'Total Cashiers','value'=>Cashier::count(),'icon'=>'bi-people-fill','color'=>'text-primary'],
            ['title'=>'Active','value'=>Cashier::where('status','active')->count(),'icon'=>'bi-person-check-fill','color'=>'text-success'],
            ['title'=>'Inactive','value'=>Cashier::where('status','inactive')->count(),'icon'=>'bi-person-x-fill','color'=>'text-warning'],
            ['title'=>'Terminated','value'=>Cashier::where('status','terminated')->count(),'icon'=>'bi-person-dash-fill','color'=>'text-danger'],
        ];
    
        return view('admin.pages.cashier.index', compact('cashiers', 'cards'));
    }    

    public function show(Cashier $cashier)
    {
        return view('admin.pages.cashier.show', compact('cashier'));
    }

    public function create()
    {
        return view('admin.pages.cashier.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name'   => 'required|string|max:50',
            'last_name'    => 'required|string|max:50',
            'phone'        => 'nullable|string|max:20',
            'email'        => 'nullable|email|unique:cashiers,email',
            'address'      => 'nullable|string|max:255',
            'profile_image'=> 'nullable|image|max:2048',
            'date_hired'   => 'nullable|date',
            'shift'        => 'nullable|in:morning,afternoon,night',
            'float_amount' => 'nullable|numeric|min:0',
            'notes'        => 'nullable|string',
        ]);

        $data = $request->all();

        $data['employee_id']  = 'EMP' . strtoupper(uniqid());
        $data['cashier_code'] = 'CASH' . strtoupper(substr(uniqid(), -6));

        $data['status'] = 'active';

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/cashiers'), $filename);
            $data['profile_image'] = 'images/cashiers/' . $filename;
        }

        Cashier::create($data);

        return redirect()->route('admin.cashiers.index')
                        ->with('success', 'Cashier created successfully.');
    }

    public function update(Request $request, Cashier $cashier)
    {
        $request->validate([
            'first_name'   => 'required|string|max:50',
            'last_name'    => 'required|string|max:50',
            'phone'        => 'nullable|string|max:20',
            'email'        => 'nullable|email|unique:cashiers,email,' . $cashier->id,
            'address'      => 'nullable|string|max:255',
            'profile_image'=> 'nullable|image|max:2048',
            'date_hired'   => 'nullable|date',
            'shift'        => 'nullable|in:morning,afternoon,night',
            'float_amount' => 'nullable|numeric|min:0',
            'notes'        => 'nullable|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('profile_image')) {
            if ($cashier->profile_image && file_exists(public_path($cashier->profile_image))) {
                unlink(public_path($cashier->profile_image));
            }

            $image = $request->file('profile_image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/cashiers'), $filename);
            $data['profile_image'] = 'images/cashiers/' . $filename;
        }

        $cashier->update($data);

        return redirect()->route('admin.cashiers.index')
                        ->with('success', 'Cashier updated successfully.');
    }

    public function toggleStatus(Cashier $cashier)
    {
        $cashier->status = $cashier->status === 'active' ? 'inactive' : 'active';
        $cashier->save();

        return redirect()->route('admin.cashiers.index')
            ->with('success', 'Cashier status updated successfully.');
    }

    public function exportCsv()
    {
        $cashiers = Cashier::all();
        $filename = 'cashiers_' . now()->format('Ymd_His') . '.csv';
        $headers = ['Content-Type' => 'text/csv'];
        
        $callback = function() use ($cashiers) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Employee ID','Cashier Code','Full Name','Email','Phone','Shift','Status','Date Hired','Float Amount']);
            foreach ($cashiers as $c) {
                fputcsv($file, [
                    $c->employee_id,
                    $c->cashier_code,
                    $c->full_name,
                    $c->email,
                    $c->phone,
                    $c->shift,
                    $c->status,
                    $c->date_hired?->format('Y-m-d'),
                    $c->float_amount,
                ]);
            }
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers)->withHeaders([
            'Content-Disposition' => "attachment; filename={$filename}"
        ]);
    }

    public function exportPdf()
    {
        $cashiers = Cashier::all();
        $pdf = Pdf::loadView('admin.pages.cashier.pdf', compact('cashiers'));
        return $pdf->download('cashiers_' . now()->format('Ymd_His') . '.pdf');
    }
}
