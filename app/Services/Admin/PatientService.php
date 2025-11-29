<?php

namespace App\Services\Admin;

use App\Models\Patient;
use Illuminate\Http\Request;
use PDF;

class PatientService
{
    public function listPatients(Request $request, $perPage = 10)
    {
        $query = Patient::query();

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', "%{$request->search}%")
                  ->orWhere('last_name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%")
                  ->orWhere('phone', 'like', "%{$request->search}%");
            });
        }

        $patients = $query->orderBy('created_at', 'desc')->paginate($perPage);

        $cards = [
            ['icon' => 'bi-people-fill', 'title' => 'Total Patients', 'value' => Patient::count(), 'color' => 'text-secondary'],
            ['icon' => 'bi-gender-male', 'title' => 'Male Patients', 'value' => Patient::where('gender', 'male')->count(), 'color' => 'text-primary'],
            ['icon' => 'bi-gender-female', 'title' => 'Female Patients', 'value' => Patient::where('gender', 'female')->count(), 'color' => 'text-danger'],
        ];

        return compact('patients', 'cards');
    }

    public function createPatient(array $data)
    {
        return Patient::create($data);
    }

    public function updatePatient(Patient $patient, array $data)
    {
        return $patient->update($data);
    }

    public function getPatientCards(Patient $patient)
    {
        $totalVisits = $patient->visits()->count();
        $lastVisit = $patient->visits()->first();
        $upcomingAppointment = method_exists($patient, 'appointments') 
                                ? $patient->appointments()->where('appointment_date', '>=', now())->first()
                                : null;

        return [
            ['title' => 'Total Visits', 'value' => $totalVisits],
            ['title' => 'Last Visit', 'value' => $lastVisit?->visit_date?->format('M d, Y') ?? '-'],
            ['title' => 'Upcoming Appointment', 'value' => $upcomingAppointment?->appointment_date?->format('M d, Y') ?? '-', 'color' => 'text-success fw-bold'],
            ['title' => 'Critical Notes', 'value' => '0', 'color' => 'text-danger fw-bold'],
        ];
    }

    public function exportCsv()
    {
        $patients = Patient::all();
        $filename = "patients_" . date('Y-m-d') . ".csv";

        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
        ];

        $columns = ['ID','First Name','Last Name','Email','Phone','Gender','DOB','Blood Group','Emergency Contact','Insurance','Allergies','Medications'];

        $callback = function() use ($patients, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($patients as $p) {
                fputcsv($file, [
                    $p->id,
                    $p->first_name,
                    $p->last_name,
                    $p->email,
                    $p->phone,
                    $p->gender,
                    $p->dob,
                    $p->blood_group,
                    $p->emergency_contact,
                    $p->insurance,
                    $p->allergies,
                    $p->medications,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPdf()
    {
        $patients = Patient::all();

        $pdf = PDF::loadView('admin.pages.patients.export', compact('patients'))
                    ->setPaper('a4', 'portrait');

        return $pdf->download('patients_' . date('Y-m-d') . '.pdf');
    }
}
