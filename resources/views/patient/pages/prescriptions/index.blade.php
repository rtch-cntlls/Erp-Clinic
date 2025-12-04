@extends('layouts.patient')
@section('title', 'My Prescriptions')
@section('content')
<div class="container" style="margin-top:130px;">
    <h2 class="fw-bold mb-4">My Prescriptions</h2>

    @if($prescriptions->isEmpty())
        <div class="alert alert-info">No prescriptions available.</div>
    @else
        <div class="card shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Doctor</th>
                            <th>Date</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($prescriptions as $p)
                        <tr>
                            <td>{{ $p->doctor->name ?? 'N/A' }}</td>
                            <td>{{ $p->created_at->format('Y-m-d') }}</td>
                            <td>{{ $p->notes }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection
