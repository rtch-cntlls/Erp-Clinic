<?php

namespace App\Http\Controllers\Pharmacist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PharmacistProfileController extends Controller
{
    public function index()
    {
        $pharmacist = Auth::guard('pharmacist')->user();
        return view('pharmacist.pages.profile.index', compact('pharmacist'));
    }
}
