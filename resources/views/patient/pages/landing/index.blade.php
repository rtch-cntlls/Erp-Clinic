@extends('layouts.patient')
@section('title', 'Welcome to CarePoint Clinic')
@section('content')
<section class="hero d-flex align-items-center mt-5" style="
    background: url('{{ asset('images/hero.jpg') }}') center/cover no-repeat;
    min-height: 80vh; position: relative; color: #fff;">
    <div class="container text-center position-relative" style="z-index: 2;">
        <h1 class="display-4 fw-bold">Welcome to
            <span style="color: #e60073;">Care</span><span style="color: #00bfff;">Point</span>
        Clinic</h1>
        <p class="lead mb-4">Comprehensive care for your family’s health. Book appointments, manage prescriptions, and track your medical history effortlessly.</p>
        <a href="#services" class="btn btn-light rounded-pill shadow-sm">Learn More</a>
    </div>
</section>
<section id="services" class="section bg-light py-5">
    <div class="container">
        <h2 class="fw-bold text-center mb-5">Our Core Services</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 text-center p-4">
                    <i class="bi bi-calendar-check fs-1 text-primary mb-3"></i>
                    <h5 class="fw-bold mb-2">Appointment Scheduling</h5>
                    <p class="text-muted">Book consultations with our experienced doctors easily. Receive reminders and updates automatically so you never miss an appointment.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 text-center p-4">
                    <i class="bi bi-box-seam fs-1 text-success mb-3"></i>
                    <h5 class="fw-bold mb-2">Pharmacy & Medication</h5>
                    <p class="text-muted">Access your prescriptions online, request refills, and collect medications quickly from our in-house pharmacy. Stay on top of your treatment plan.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 text-center p-4">
                    <i class="bi bi-file-earmark-medical fs-1 text-warning mb-3"></i>
                    <h5 class="fw-bold mb-2">Electronic Medical Records</h5>
                    <p class="text-muted">Your medical history is stored securely. View past visits, lab results, and prescriptions anytime for better continuity of care.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="about" class="section py-5">
    <div class="container">
        <h2 class="fw-bold text-center mb-4">About  <span style="color: #e60073;">Care</span><span style="color: #00bfff;">Point</span> Clinic</h2>
        <p class="text-center text-muted mb-5">At CarePoint Clinic, we believe in holistic, patient-centered care. Our dedicated team of doctors, nurses, and support staff work together to provide personalized treatment plans while leveraging modern technology to streamline your healthcare experience.</p>
        <div class="row g-4 align-items-center">
            <div class="col-md-6">
                <img src="{{ asset('images/about.png') }}" class="img-fluid shadow-sm" alt="">
            </div>
            <div class="col-md-6">
                <h5 class="fw-bold mb-3">Why Choose Us?</h5>
                <ul class="list-unstyled text-muted">
                    <li class="mb-2"><i class="bi bi-check-circle text-primary me-2"></i> Experienced and compassionate medical staff</li>
                    <li class="mb-2"><i class="bi bi-check-circle text-primary me-2"></i> Modern facilities and advanced equipment</li>
                    <li class="mb-2"><i class="bi bi-check-circle text-primary me-2"></i> Integrated system for appointments, prescriptions, and records</li>
                    <li class="mb-2"><i class="bi bi-check-circle text-primary me-2"></i> Patient-focused, friendly care environment</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section id="how-it-works" class="section py-5 bg-light">
    <div class="container">
        <h2 class="fw-bold text-center mb-5">How It Works</h2>
        <div class="row g-4 text-center">
            <div class="col-md-4">
                <i class="bi bi-pencil-square fs-1 text-primary mb-3"></i>
                <h5 class="fw-bold mb-2">Book Your Appointment</h5>
                <p class="text-muted">Select your preferred doctor, date, and time online, and receive instant confirmation and reminders.</p>
            </div>
            <div class="col-md-4">
                <i class="bi bi-file-medical fs-1 text-success mb-3"></i>
                <h5 class="fw-bold mb-2">Access Your Medical Records</h5>
                <p class="text-muted">View your visit history, lab results, and prescriptions securely online from anywhere.</p>
            </div>
            <div class="col-md-4">
                <i class="bi bi-capsule fs-1 text-warning mb-3"></i>
                <h5 class="fw-bold mb-2">Manage Medications</h5>
                <p class="text-muted">Request refills and pick up medicines efficiently through our integrated pharmacy system, ensuring uninterrupted treatment.</p>
            </div>
        </div>
    </div>
</section>
<section id="contact" class="section py-5 text-center">
    <div class="container">
        <h2 class="fw-bold mb-4">Contact Us</h2>
        <p class="mb-4">Get in touch for appointments, inquiries, or general support. Our friendly staff is here to assist you.</p>
        <a href="mailto:info@CarePointclinic.com" class="btn btn-primary rounded-pill shadow-sm me-2 mb-2">
            <i class="bi bi-envelope me-1"></i> Email Us
        </a>
        <a href="tel:+1234567890" class="btn btn-outline-primary rounded-pill shadow-sm mb-2">
            <i class="bi bi-telephone me-1"></i> Call Us
        </a>
    </div>
</section>
<a href="mailto:info@CarePointclinic.com" class="floating-contact">
    <i class="bi bi-chat-dots"></i>
</a>

@endsection
