<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Services\Admin\DoctorService;
use Illuminate\Support\Facades\Response;
use PDF; 

class DoctorController extends Controller
{
    protected $service;

    public function __construct(DoctorService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $doctors = $this->service->getAllPaginated(10, $search);
        $cards = $this->service->getDashboardCards();

        return view('admin.pages.doctors.index', compact('doctors', 'cards'));
    }

    public function create()
    {
        return view('admin.pages.doctors.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name'        => 'required|string|max:255',
            'last_name'         => 'required|string|max:255',
            'email'             => 'required|email|unique:doctors,email',
            'phone'             => 'required|string|max:20',
            'gender'            => 'required|string|max:10',
            'birthdate'         => 'required|date',

            'license_no'        => 'required|string|unique:doctors,license_no',
            'ptr_no'            => 'nullable|string|max:255',
            's2_no'             => 'nullable|string|max:255',
            'specialization'    => 'required|string|max:255',
            'sub_specialization'=> 'nullable|string|max:255',
            'department'        => 'nullable|string|max:255',
            'years_experience'  => 'nullable|integer|min:0',

            'consultation_fee'  => 'required|numeric|min:0',
            'address'           => 'required|string',
            'bio'               => 'nullable|string',
            'status'            => 'required|in:active,inactive',

            'profile_image'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $this->service->create($data);

        return redirect()->route('admin.doctors.index')
            ->with('success', 'Doctor added successfully.');
    }

    public function show(Doctor $doctor)
    {
        return view('admin.pages.doctors.show', compact('doctor'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $data = $request->validate([
            'first_name'        => 'required|string|max:255',
            'last_name'         => 'required|string|max:255',
            'email'             => 'required|email|unique:doctors,email,' . $doctor->id,
            'phone'             => 'nullable|string|max:20',
            'gender'            => 'nullable|string|max:10',
            'birthdate'         => 'nullable|date',

            'license_no'        => 'required|string|unique:doctors,license_no,' . $doctor->id,
            'ptr_no'            => 'nullable|string|max:255',
            's2_no'             => 'nullable|string|max:255',
            'specialization'    => 'required|string|max:255',
            'sub_specialization'=> 'nullable|string|max:255',
            'department'        => 'nullable|string|max:255',
            'years_experience'  => 'nullable|integer|min:0',

            'consultation_fee'  => 'nullable|numeric|min:0',
            'address'           => 'nullable|string',
            'bio'               => 'nullable|string',
            'status'            => 'required|in:active,inactive',

            'profile_image'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $this->service->update($doctor, $data);

        return redirect()->route('admin.doctors.index')
            ->with('success', 'Doctor updated successfully.');
    }

    public function toggleStatus(Doctor $doctor)
    {
        $this->service->toggleStatus($doctor);

        return back()->with('success', 'Doctor status updated successfully.');
    }
    
    public function exportCsv()
    {
        $doctors = Doctor::select([
            'first_name',
            'last_name',
            'email',
            'phone',
            'gender',
            'birthdate',
            'license_no',
            'ptr_no',
            's2_no',
            'specialization',
            'sub_specialization',
            'department',
            'address',
        ])->get();

        $csvHeader = [
            'First Name', 'Last Name', 'Email', 'Phone', 'Gender', 'Birthdate',
            'License No', 'PTR No', 'S2 No', 'Specialization', 'Sub Specialization', 'Department', 'Address'
        ];

        $filename = 'doctors_' . date('Ymd_His') . '.csv';
        $handle = fopen('php://memory', 'w');
        fputcsv($handle, $csvHeader);

        foreach ($doctors as $doctor) {
            fputcsv($handle, [
                $doctor->first_name,
                $doctor->last_name,
                $doctor->email,
                $doctor->phone,
                $doctor->gender,
                $doctor->birthdate,
                $doctor->license_no,
                $doctor->ptr_no,
                $doctor->s2_no,
                $doctor->specialization,
                $doctor->sub_specialization,
                $doctor->department,
                $doctor->address,
            ]);
        }

        rewind($handle);
        $content = stream_get_contents($handle);
        fclose($handle);

        return response($content, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$filename",
        ]);
    }

    public function exportPdf()
    {
        $doctors = Doctor::select([
            'first_name',
            'last_name',
            'email',
            'phone',
            'gender',
            'birthdate',
            'license_no',
            'ptr_no',
            's2_no',
            'specialization',
            'sub_specialization',
            'department',
            'address',
        ])->get();

        $pdf = Pdf::loadView('admin.pages.doctors.pdf', compact('doctors'))
                ->setPaper('a4', 'landscape');
                
        return $pdf->download('doctors_' . date('Ymd_His') . '.pdf');
    }
}
