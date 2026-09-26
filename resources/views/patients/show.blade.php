@extends('layouts.admin')

@section('title', 'Patient Details')

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

    .status-badge.active {
        background: #ecfdf5;
        color: #059669;
    }

    .status-badge.inactive {
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
        <h1>Patient Details</h1>
        <p>View full information for this patient.</p>
    </div>

</div>


<!-- ========== SHOW CARD ========== -->
<div class="department-show-wrap">

    <div class="department-show-card">


        <!-- ========== HEADER ========== -->
        <div class="department-show-header">

            <div>
                <h2>{{ $patient->user->name }}</h2>
                <p>Patient Information</p>
            </div>

            <span class="code-badge">
                #{{ $patient->id }}
            </span>

        </div>


        <!-- ========== BODY ========== -->
        <div class="department-show-body">

            <!-- PATIENT ID -->
            <div class="detail-row">
                <span class="detail-label">Patient ID</span>
                <span class="detail-value">
                    <span class="code-badge">#{{ $patient->id }}</span>
                </span>
            </div>


            <!-- NAME -->
            <div class="detail-row">
                <span class="detail-label">Name</span>
                <span class="detail-value">{{ $patient->user->name }}</span>
            </div>


            <!-- DATE OF BIRTH -->
            <div class="detail-row">
                <span class="detail-label">Date of Birth</span>
                <span class="detail-value">
                    {{ $patient->date_of_birth ? \Carbon\Carbon::parse($patient->date_of_birth)->format('d M Y') : '—' }}
                </span>
            </div>


            <!-- GENDER -->
            <div class="detail-row">
                <span class="detail-label">Gender</span>
                <span class="detail-value">{{ ucfirst($patient->gender) }}</span>
            </div>


            <!-- PHONE -->
            <div class="detail-row">
                <span class="detail-label">Phone</span>
                <span class="detail-value">{{ $patient->user->phone }}</span>
            </div>


            <!-- EMAIL -->
            <div class="detail-row">
                <span class="detail-label">Email</span>
                <span class="detail-value">{{ $patient->user->email ?? '—' }}</span>
            </div>


            <!-- DOCTOR -->
            <div class="detail-row">
                <span class="detail-label">Doctor</span>
                <span class="detail-value">{{ $patient->doctor->user->name ?? '—' }}</span>
            </div>


            <!-- DEPARTMENT -->
            <div class="detail-row">
                <span class="detail-label">Department</span>
                <span class="detail-value">{{ $patient->department->name ?? '—' }}</span>
            </div>


            <!-- ADDRESS -->
            <div class="detail-row">
                <span class="detail-label">Address</span>
                <span class="detail-value">{{ $patient->address ?? '—' }}</span>
            </div>


            <!-- BLOOD GROUP -->
            <div class="detail-row">
                <span class="detail-label">Blood Group</span>
                <span class="detail-value">{{ $patient->blood_group ?? '—' }}</span>
            </div>


            <!-- EMERGENCY CONTACT -->
            <div class="detail-row">
                <span class="detail-label">Emergency Contact</span>
                <span class="detail-value">{{ $patient->emergency_contact ?? '—' }}</span>
            </div>


            <!-- EMERGENCY CONTACT NAME -->
            <div class="detail-row">
                <span class="detail-label">Emergency Contact Name</span>
                <span class="detail-value">{{ $patient->emergency_contact_name ?? '—' }}</span>
            </div>


            <!-- MEDICAL HISTORY -->
            <div class="detail-row">
                <span class="detail-label">Medical History</span>
                <span class="detail-value">{{ $patient->medical_history ?? '—' }}</span>
            </div>


            <!-- ALLERGIES -->
            <div class="detail-row">
                <span class="detail-label">Allergies</span>
                <span class="detail-value">{{ $patient->allergies ?? '—' }}</span>
            </div>


            <!-- STATUS -->
            <div class="detail-row">
                <span class="detail-label">Status</span>
                <span class="detail-value">
                    <span class="status-badge {{ strtolower($patient->user->status ?? 'inactive') }}">
                        <span class="status-dot"></span>
                        {{ $patient->user->status ?? 'inactive' }}
                    </span>
                </span>
            </div>


            <!-- REGISTERED -->
            <div class="detail-row">
                <span class="detail-label">Registered</span>
                <span class="detail-value">
                    {{ $patient->created_at ? $patient->created_at->format('d M Y, h:i A') : '—' }}
                </span>
            </div>


            <!-- UPDATED -->
            <div class="detail-row">
                <span class="detail-label">Last Updated</span>
                <span class="detail-value">
                    {{ $patient->updated_at ? $patient->updated_at->format('d M Y, h:i A') : '—' }}
                </span>
            </div>


            <!-- ACTIONS -->
            <div class="form-actions">


                    href="{{ route('patients.index') }}"
                    class="btn-cancel"
                >
                    Back
                </a>


                    href="{{ route('patients.edit', $patient->id) }}"
                    class="btn-submit"
                >
                    <i class="fas fa-pen"></i>
                    Edit Patient
                </a>

            </div>

        </div>

    </div>

</div>

</main>

@endsection
