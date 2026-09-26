@extends('layouts.admin')

@section('title', 'All Admissions')

@section('content')

    <style>
        .admissions-page-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 22px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .admissions-page-title h1 {
            font-size: 22px;
            font-weight: 700;
            color: #1f2937;
            margin: 0;
        }

        .admissions-page-title p {
            color: #6b7280;
            font-size: 13.5px;
            margin: 4px 0 0;
        }

        .btn-new-admission {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: 0.2s;
        }

        .btn-new-admission:hover {
            opacity: 0.92;
            color: #fff;
            transform: translateY(-1px);
        }

        .alert-box {
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 18px;
        }

        .alert-success {
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #047857;
        }

        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
        }

        .admissions-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.06);
            border: 1px solid #eef0f4;
            overflow: hidden;
        }

        .admissions-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 24px;
            border-bottom: 1px solid #eef0f4;
        }

        .admissions-card-header h3 {
            font-size: 16px;
            font-weight: 700;
            color: #1f2937;
            margin: 0;
        }

        .admissions-count-badge {
            background: #eef2ff;
            color: #4f46e5;
            font-size: 12.5px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 20px;
        }

        .admissions-table-wrap {
            overflow-x: auto;
        }

        .admissions-table {
            width: 100%;
            border-collapse: collapse;
        }

        .admissions-table thead th {
            text-align: left;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            color: #6b7280;
            background: #f9fafb;
            padding: 12px 20px;
            border-bottom: 1px solid #eef0f4;
            white-space: nowrap;
        }

        .admissions-table tbody td {
            padding: 14px 20px;
            font-size: 14px;
            color: #374151;
            border-bottom: 1px solid #f1f2f6;
            vertical-align: middle;
            white-space: nowrap;
        }

        .admissions-table tbody tr:last-child td {
            border-bottom: none;
        }

        .admissions-table tbody tr:hover {
            background: #fafaff;
        }

        .admission-cell strong {
            display: block;
            color: #1f2937;
            font-size: 13.5px;
        }

        .admission-cell span {
            display: block;
            color: #9ca3af;
            font-size: 12px;
            margin-top: 2px;
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

        .status-badge.admitted {
            background: #ecfdf5;
            color: #059669;
        }

        .status-badge.discharged {
            background: #f3f4f6;
            color: #6b7280;
        }

        .status-badge.transferred {
            background: #fef3c7;
            color: #b45309;
        }

        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .action-icons {
            white-space: nowrap;
        }

        .action-icons a,
        .action-icons button {
            margin-right: 12px;
            border: none;
            background: none;
            cursor: pointer;
            padding: 0;
            font-size: 14px;
        }

        .action-icons a:last-child,
        .action-icons button:last-child {
            margin-right: 0;
        }

        .empty-state {
            text-align: center;
            padding: 45px 20px;
            color: #6b7280;
        }

        .empty-state i {
            font-size: 40px;
            color: #c7d2fe;
            margin-bottom: 12px;
        }

        .empty-state h4 {
            margin: 0 0 5px;
            color: #374151;
            font-size: 16px;
        }

        .empty-state p {
            margin: 0;
            font-size: 13px;
        }

        @media (max-width: 768px) {
            .admissions-page-title {
                align-items: flex-start;
            }

            .btn-new-admission {
                width: 100%;
                justify-content: center;
            }

            .admissions-card-header {
                padding: 16px;
            }

            .admissions-table thead th,
            .admissions-table tbody td {
                padding: 12px 14px;
            }
        }
    </style>

    <main class="content">

        <!-- Page Header -->
        <div class="admissions-page-title">
            <div>
                <h1>All Admissions</h1>
                <p>Manage patient admissions</p>
            </div>

            <a href="{{ route('admissions.create') }}" class="btn-new-admission">
                <i class="fas fa-plus"></i>
                Add Admission
            </a>
        </div>


        <!-- Success Message -->
        @if (session('success'))
            <div class="alert-box alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif


        <!-- Error Message -->
        @if (session('error'))
            <div class="alert-box alert-error">
                <i class="fas fa-exclamation-circle"></i>
                {{ session('error') }}
            </div>
        @endif


        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="alert-box alert-error">
                <strong>Please fix the following errors:</strong>

                <ul style="margin: 8px 0 0 18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <!-- Admissions Card -->
        <div class="admissions-card">

            <!-- Card Header -->
            <div class="admissions-card-header">
                <h3>
                    <i class="fas fa-bed" style="margin-right: 7px; color:#6366f1;"></i>
                    Patient Admissions
                </h3>

                <span class="admissions-count-badge">
                    {{ $admissions->count() }} total
                </span>
            </div>


            <!-- Table -->
            <div class="admissions-table-wrap">

                <table class="admissions-table">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Patient</th>
                            <th>Doctor</th>
                            <th>Ward / Bed</th>
                            <th>Admitted On</th>
                            <th>Discharged On</th>
                            <th>Charges</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>


                    <tbody>

                        @forelse($admissions as $admission)
                            <tr>

                                <!-- ID -->
                                <td>
                                    <span class="code-badge">
                                        #{{ $admission->id }}
                                    </span>
                                </td>


                                <!-- Patient -->
                                <td>
                                    <div class="admission-cell">
                                        <strong>{{ $admission->patient->user->name ?? '—' }}</strong>
                                        @if($admission->reason)
                                            <span>{{ Str::limit($admission->reason, 30) }}</span>
                                        @endif
                                    </div>
                                </td>


                                <!-- Doctor -->
                                <td>
                                    {{ $admission->doctor->user->name ?? '—' }}
                                </td>


                                <!-- Ward / Bed -->
                                <td>
                                    {{ $admission->ward ?? '—' }}
                                    @if($admission->bed_number)
                                        <span style="color:#9ca3af; font-size:12px;">/ Bed {{ $admission->bed_number }}</span>
                                    @endif
                                </td>


                                <!-- Admitted On -->
                                <td>
                                    {{ $admission->admission_date ? $admission->admission_date->format('d M Y, h:i A') : '—' }}
                                </td>


                                <!-- Discharged On -->
                                <td>
                                    {{ $admission->discharge_date ? $admission->discharge_date->format('d M Y, h:i A') : '—' }}
                                </td>


                                <!-- Charges -->
                                <td>
                                    ₹{{ number_format($admission->total_charges, 2) }}
                                </td>


                                <!-- Status -->
                                <td>
                                    <span class="status-badge {{ $admission->status }}">
                                        <span class="status-dot"></span>
                                        {{ $admission->status }}
                                    </span>
                                </td>


                                <!-- Actions -->
                                <td class="action-icons">

                                    <!-- Show -->
                                    <a href="{{ route('admissions.show', $admission->id) }}" title="Show Admission">
                                        <i class="fas fa-eye" style="color:#6366f1;"></i>
                                    </a>

                                    <!-- Edit -->
                                    <a href="{{ route('admissions.edit', $admission->id) }}" title="Edit Admission">
                                        <i class="fas fa-pen" style="color:#6366f1;"></i>
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('admissions.destroy', $admission->id) }}" method="POST"
                                        style="display:inline;"
                                        onsubmit="return confirm('Are you sure you want to delete this admission record?');">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" title="Delete Admission">
                                            <i class="fas fa-trash" style="color:#dc2626;"></i>
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="9">

                                    <div class="empty-state">

                                        <i class="fas fa-bed"></i>

                                        <h4>No Admissions Found</h4>

                                        <p>
                                            No patient admissions have been recorded yet.
                                        </p>

                                    </div>

                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </main>

@endsection
