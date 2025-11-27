@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Welcome, {{ auth()->guard('admin')->user()->name }}</h1>
    <p class="text-muted">This is your Clinic ERP admin dashboard.</p>
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card text-center bg-primary text-white mb-3">
                <div class="card-body">
                    <h5>Patients</h5>
                    <p>Manage Patients</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-success text-white mb-3">
                <div class="card-body">
                    <h5>Appointments</h5>
                    <p>View & Schedule</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-warning text-dark mb-3">
                <div class="card-body">
                    <h5>Billing</h5>
                    <p>Manage Billing</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-info text-white mb-3">
                <div class="card-body">
                    <h5>Inventory</h5>
                    <p>Track Inventory</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-3">
            <div class="card text-center bg-secondary text-white mb-3">
                <div class="card-body">
                    <h5>Pharmacy</h5>
                    <p>Manage Medicines</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-danger text-white mb-3">
                <div class="card-body">
                    <h5>HR</h5>
                    <p>Manage Staff</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-dark text-white mb-3">
                <div class="card-body">
                    <h5>Reports</h5>
                    <p>View Reports</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
