<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\PatientService;
use Illuminate\Http\Request;
use App\Models\Patient;

class PatientController extends Controller
{
    protected $service;

    public function __construct(PatientService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $data = $this->service->listPatients($request);
        return view('admin.pages.patients.index', $data);
    }

    public function create()
    {
        return view('admin.pages.patients.create');
    }

    public function store(Request $request)
    {
        $this->service->createPatient($request->all());
        return redirect()->route('admin.patients.index')
                         ->with('success', 'Patient created successfully.');
    }

    public function show(Patient $patient)
    {
        $cards = $this->service->getPatientCards($patient);
        return view('admin.pages.patients.show', compact('patient', 'cards'));
    }

    public function update(Request $request, Patient $patient)
    {
        $this->service->updatePatient($patient, $request->all());
        return redirect()->route('admin.patients.index')
                         ->with('success', 'Patient updated successfully.');
    }

    public function exportCsv()
    {
        return $this->service->exportCsv();
    }

    public function exportPdf()
    {
        return $this->service->exportPdf();
    }
}