<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Receptionist;
use Illuminate\Support\Facades\Hash;

class ReceptionistController extends Controller
{
    public function index()
    {
        $receptionists = Receptionist::latest()->get();
    
        $cards = [
            [
                'title' => 'Total Receptionists',
                'value' => Receptionist::count(),
                'icon'  => 'bi-people-fill',
                'color' => 'text-primary'
            ],
        ];
    
        return view('admin.pages.receptionists.index', compact('receptionists', 'cards'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:receptionists,email',
            'phone'    => 'required|string|max:20',
            'password' => 'required|min:6',
        ]);

        Receptionist::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Receptionist added successfully.');
    }

    public function update(Request $request, Receptionist $receptionist)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:receptionists,email,' . $receptionist->id,
            'phone'    => 'required|string|max:20',
        ]);

        $receptionist->update([
            'name'   => $request->name,
            'email'  => $request->email,
            'phone'  => $request->phone,
        ]);

        return back()->with('success', 'Receptionist updated successfully.');
    }
}
