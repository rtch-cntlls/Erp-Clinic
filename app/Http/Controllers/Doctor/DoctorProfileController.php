<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DoctorSchedule;
use Carbon\Carbon;

class DoctorProfileController extends Controller
{
    public function index()
    {
        $doctor = auth()->guard('doctor')->user();
        $schedules = $doctor->schedules()->orderBy('day')->get();

        return view('doctor.pages.profile.index', compact('doctor', 'schedules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'day' => 'required|string|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'from' => 'required',
            'to' => 'required|after:from',
        ]);

        $doctor = auth()->guard('doctor')->user();

        DoctorSchedule::create([
            'doctor_id' => $doctor->id,
            'day' => $request->day,
            'from' => $request->from,
            'to' => $request->to,
        ]);

        return redirect()->back()->with('success', 'Schedule added successfully.');
    }
}
