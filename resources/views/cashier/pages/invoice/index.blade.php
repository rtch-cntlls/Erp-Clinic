@extends('layouts.cashier')
@section('title', 'Invoices')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold"><i class="bi bi-receipt me-2"></i>Invoices</h3>
        <a href="{{ route('cashier.invoices.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Add Invoice
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Invoice No</th>
                    <th>Patient</th>
                    <th>Amount to Pay</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($invoices as $invoice)
                    <tr>
                        <td>{{ $invoice->invoice_no }}</td>
                        <td>{{ $invoice->patient->name }}</td>
                        <td>₱{{ number_format($invoice->total_amount, 2) }}</td>
                        <td>
                            <span class="badge bg-{{ $invoice->status == 'paid' ? 'success' : ($invoice->status == 'pending' ? 'warning' : 'danger') }}">
                                {{ ucfirst($invoice->status) }}
                            </span>
                        </td>
                        <td>
                            @if($invoice->status == 'paid')
                                <a href="{{ asset('receipts/' . $invoice->invoice_no . '.pdf') }}" target="_blank" class="btn btn-sm btn-primary">
                                    <i class="bi bi-download"></i> Receipt
                                </a>
                            @endif
                            @if($invoice->status != 'paid')
                                <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#payModal{{ $invoice->id }}">
                                    <i class="bi bi-cash-stack"></i> Pay
                                </button>
                               @include('cashier.pages.invoice.pay', ['invoice' => $invoice])
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            <i class="bi bi-exclamation-circle me-2"></i> No invoices found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3 d-flex justify-content-end">
        {{ $invoices->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
