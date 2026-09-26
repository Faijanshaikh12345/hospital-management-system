@extends('layouts.admin')

@section('title', 'Invoice Details')

@section('content')

<style>
    .department-show-wrap {
        max-width: 700px;
        margin: 0 auto;
    }

    .department-show-card {
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.06);
        border: 1px solid #eef0f4;
        overflow: hidden;
    }

    .department-show-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 22px 24px;
        border-bottom: 1px solid #eef0f4;
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    }

    .department-show-header h2 {
        color: #fff;
        font-size: 19px;
        font-weight: 700;
        margin: 0;
    }

    .department-show-header p {
        color: rgba(255, 255, 255, 0.85);
        font-size: 13px;
        margin: 4px 0 0;
    }

    .department-show-body {
        padding: 26px;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: 14px 0;
        border-bottom: 1px solid #f1f2f6;
        gap: 20px;
    }

    .detail-row:last-child {
        border-bottom: none;
    }

    .detail-row.total-row {
        border-top: 2px solid #eef0f4;
        margin-top: 6px;
        padding-top: 16px;
    }

    .detail-label {
        font-size: 13px;
        font-weight: 600;
        color: #6b7280;
        min-width: 140px;
    }

    .detail-value {
        font-size: 14.5px;
        color: #1f2937;
        text-align: right;
        flex: 1;
    }

    .detail-value.amount-strong {
        font-size: 16px;
        font-weight: 700;
        color: #1f2937;
    }

    .description-value {
        text-align: left;
        line-height: 1.5;
    }

    .code-badge {
        display: inline-flex;
        align-items: center;
        font-size: 12px;
        font-weight: 700;
        padding: 5px 11px;
        border-radius: 20px;
        background: #eef2ff;
        color: #4f46e5;
    }

    .balance-due {
        color: #dc2626;
        font-weight: 700;
    }

    .balance-clear {
        color: #059669;
        font-weight: 700;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 12px;
        font-weight: 600;
        padding: 5px 10px;
        border-radius: 20px;
        text-transform: capitalize;
    }

    .status-badge.paid {
        background: #ecfdf5;
        color: #059669;
    }

    .status-badge.pending {
        background: #fef3c7;
        color: #b45309;
    }

    .status-badge.partially_paid {
        background: #e0f2fe;
        color: #0369a1;
    }

    .status-badge.cancelled {
        background: #fef2f2;
        color: #dc2626;
    }

    .status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 24px;
    }

    .btn-cancel {
        padding: 11px 22px;
        background: #f3f4f6;
        color: #374151;
        border: none;
        border-radius: 8px;
        font-size: 14.5px;
        font-weight: 600;
        text-decoration: none;
    }

    .btn-cancel:hover {
        background: #e5e7eb;
    }

    .btn-submit {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 11px 26px;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 14.5px;
        font-weight: 600;
        text-decoration: none;
    }

    .btn-submit:hover {
        opacity: 0.92;
        color: #fff;
    }
</style>

<main class="content">

<!-- ========== PAGE TITLE ========== -->
<div class="page-title">

    <div>
        <h1>Invoice Details</h1>
        <p>View full information for this invoice.</p>
    </div>

</div>


<!-- ========== SHOW CARD ========== -->
<div class="department-show-wrap">

    <div class="department-show-card">


        <!-- ========== HEADER ========== -->
        <div class="department-show-header">

            <div>
                <h2>{{ $billing->invoice_number }}</h2>
                <p>Invoice for {{ $billing->patient->user->name ?? '—' }}</p>
            </div>

            <span class="code-badge">
                #{{ $billing->id }}
            </span>

        </div>


        <!-- ========== BODY ========== -->
        <div class="department-show-body">

            <!-- PATIENT -->
            <div class="detail-row">
                <span class="detail-label">Patient</span>
                <span class="detail-value">{{ $billing->patient->user->name ?? '—' }}</span>
            </div>


            <!-- DOCTOR -->
            <div class="detail-row">
                <span class="detail-label">Doctor</span>
                <span class="detail-value">{{ $billing->doctor->user->name ?? '—' }}</span>
            </div>


            <!-- BILLING DATE -->
            <div class="detail-row">
                <span class="detail-label">Billing Date</span>
                <span class="detail-value">
                    {{ $billing->billing_date ? $billing->billing_date->format('d M Y') : '—' }}
                </span>
            </div>


            <!-- CONSULTATION FEE -->
            <div class="detail-row">
                <span class="detail-label">Consultation Fee</span>
                <span class="detail-value">₹{{ number_format($billing->consultation_fee, 2) }}</span>
            </div>


            <!-- MEDICINE CHARGES -->
            <div class="detail-row">
                <span class="detail-label">Medicine Charges</span>
                <span class="detail-value">₹{{ number_format($billing->medicine_charges, 2) }}</span>
            </div>


            <!-- OTHER CHARGES -->
            <div class="detail-row">
                <span class="detail-label">Other Charges</span>
                <span class="detail-value">₹{{ number_format($billing->other_charges, 2) }}</span>
            </div>


            <!-- DISCOUNT -->
            <div class="detail-row">
                <span class="detail-label">Discount</span>
                <span class="detail-value">− ₹{{ number_format($billing->discount, 2) }}</span>
            </div>


            <!-- TOTAL AMOUNT -->
            <div class="detail-row total-row">
                <span class="detail-label">Total Amount</span>
                <span class="detail-value amount-strong">₹{{ number_format($billing->total_amount, 2) }}</span>
            </div>


            <!-- PAID AMOUNT -->
            <div class="detail-row">
                <span class="detail-label">Paid Amount</span>
                <span class="detail-value">₹{{ number_format($billing->paid_amount, 2) }}</span>
            </div>


            <!-- BALANCE -->
            @php $balance = $billing->total_amount - $billing->paid_amount; @endphp
            <div class="detail-row">
                <span class="detail-label">
                    @if($balance > 0)
                        Balance Due
                    @elseif($balance < 0)
                        Overpaid
                    @else
                        Balance
                    @endif
                </span>
                <span class="detail-value {{ $balance > 0 ? 'balance-due' : 'balance-clear' }}">
                    ₹{{ number_format(abs($balance), 2) }}
                </span>
            </div>


            <!-- PAYMENT METHOD -->
            <div class="detail-row">
                <span class="detail-label">Payment Method</span>
                <span class="detail-value">
                    {{ $billing->payment_method ? ucfirst($billing->payment_method) : '—' }}
                </span>
            </div>

            <!-- STATUS -->
            <div class="detail-row">
                <span class="detail-label">Status</span>
                <span class="detail-value">
                    <span class="status-badge {{ $billing->status }}">
                        <span class="status-dot"></span>
                        {{ str_replace('_', ' ', $billing->status) }}
                    </span>
                </span>
            </div>

            <!-- NOTES -->
            <div class="detail-row">
                <span class="detail-label">Notes</span>
                <span class="detail-value description-value">
                    {{ $billing->notes ?? '—' }}
                </span>
            </div>


            <!-- CREATED -->
            <div class="detail-row">
                <span class="detail-label">Created</span>
                <span class="detail-value">
                    {{ $billing->created_at ? $billing->created_at->format('d M Y, h:i A') : '—' }}
                </span>
            </div>


            <!-- ACTIONS -->
            <div class="form-actions">

                <a href="{{ route('billings.index') }}" class="btn-cancel">
                    Back
                </a>

                <a href="{{ route('billings.edit', $billing->id) }}" class="btn-submit">
                    <i class="fas fa-pen"></i>
                    Edit Invoice
                </a>

            </div>

        </div>

    </div>

</div>

</main>

@endsection
