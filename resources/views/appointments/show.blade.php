@extends('layouts.admin')

@section('title', 'Appointment Details')

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

    .detail-label {
        font-size: 13px;
        font-weight: 600;
        color: #6b7280;
        min-width: 160px;
    }

    .detail-value {
        font-size: 14.5px;
        color: #1f2937;
        text-align: right;
        flex: 1;
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

    .status-badge.scheduled {
        background: #eef2ff;
        color: #4f46e5;
    }

    .status-badge.completed {
        background: #ecfdf5;
        color: #059669;
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
        <h1>Appointment Details</h1>
        <p>View full information for this appointment.</p>
    </div>

</div>


<!-- ========== SHOW CARD ========== -->
<div class="department-show-wrap">

    <div class="department-show-card">


        <!-- ========== HEADER ========== -->
        <div class="department-show-header">

            <div>
                <h2>{{ $appointment->patient->user->name ?? '—' }}</h2>
                <p>Appointment Information</p>
            </div>

            <span class="code-badge">
                {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}
            </span>

        </div>


        <!-- ========== BODY ========== -->
        <div class="department-show-body">

            <!-- PATIENT -->
            <div class="detail-row">
                <span class="detail-label">Patient</span>
                <span class="detail-value">{{ $appointment->patient->user->name ?? '—' }}</span>
            </div>


            <!-- DOCTOR -->
            <div class="detail-row">
                <span class="detail-label">Doctor</span>
                <span class="detail-value">{{ $appointment->doctor->user->name ?? '—' }}</span>
            </div>


            <!-- DATE -->
            <div class="detail-row">
                <span class="detail-label">Appointment Date</span>
                <span class="detail-value">
                    {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}
                </span>
            </div>


            <!-- TIME -->
            <div class="detail-row">
                <span class="detail-label">Appointment Time</span>
                <span class="detail-value">
                    {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                </span>
            </div>


            <!-- REASON -->
            <div class="detail-row">
                <span class="detail-label">Reason</span>
                <span class="detail-value">{{ $appointment->reason ?? '—' }}</span>
            </div>


            <!-- NOTES -->
            <div class="detail-row">
                <span class="detail-label">Notes</span>
                <span class="detail-value">{{ $appointment->notes ?? '—' }}</span>
            </div>


            <!-- STATUS -->
            <div class="detail-row">
                <span class="detail-label">Status</span>
                <span class="detail-value">
                    <span class="status-badge {{ strtolower($appointment->status) }}">
                        <span class="status-dot"></span>
                        {{ $appointment->status }}
                    </span>
                </span>
            </div>


            <!-- CREATED -->
            <div class="detail-row">
                <span class="detail-label">Created</span>
                <span class="detail-value">
                    {{ $appointment->created_at ? $appointment->created_at->format('d M Y, h:i A') : '—' }}
                </span>
            </div>


            <!-- UPDATED -->
            <div class="detail-row">
                <span class="detail-label">Last Updated</span>
                <span class="detail-value">
                    {{ $appointment->updated_at ? $appointment->updated_at->format('d M Y, h:i A') : '—' }}
                </span>
            </div>


            <!-- ACTIONS -->
            <div class="form-actions">

                <a
                    href="{{ route('appointments.index') }}"
                    class="btn-cancel"
                >
                    Back
                </a>

                <a
                    href="{{ route('appointments.edit', $appointment->id) }}"
                    class="btn-submit"
                >
                    <i class="fas fa-pen"></i>
                    Edit Appointment
                </a>

            </div>

        </div>

    </div>

</div>

</main>

@endsection
