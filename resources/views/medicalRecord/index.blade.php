@extends('layouts.admin')

@section('title', 'All Medical Records')

@section('content')

    <style>
        .medical-records-page-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 22px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .medical-records-page-title h1 {
            font-size: 22px;
            font-weight: 700;
            color: #1f2937;
            margin: 0;
        }

        .medical-records-page-title p {
            color: #6b7280;
            font-size: 13.5px;
            margin: 4px 0 0;
        }

        .btn-new-record {
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

        .btn-new-record:hover {
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

        .medical-records-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.06);
            border: 1px solid #eef0f4;
            overflow: hidden;
        }

        .medical-records-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 24px;
            border-bottom: 1px solid #eef0f4;
        }

        .medical-records-card-header h3 {
            font-size: 16px;
            font-weight: 700;
            color: #1f2937;
            margin: 0;
        }

        .medical-records-count-badge {
            background: #eef2ff;
            color: #4f46e5;
            font-size: 12.5px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 20px;
        }

        .medical-records-table-wrap {
            overflow-x: auto;
        }

        .medical-records-table {
            width: 100%;
            border-collapse: collapse;
        }

        .medical-records-table thead th {
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

        .medical-records-table tbody td {
            padding: 14px 20px;
            font-size: 14px;
            color: #374151;
            border-bottom: 1px solid #f1f2f6;
            vertical-align: middle;
            white-space: nowrap;
        }

        .medical-records-table tbody tr:last-child td {
            border-bottom: none;
        }

        .medical-records-table tbody tr:hover {
            background: #fafaff;
        }

        .record-cell strong {
            display: block;
            color: #1f2937;
            font-size: 13.5px;
        }

        .record-cell span {
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

        .type-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
            font-weight: 600;
            padding: 5px 10px;
            border-radius: 20px;
            text-transform: capitalize;
        }

        .type-badge.consultation {
            background: #eef2ff;
            color: #4f46e5;
        }

        .type-badge.lab_report {
            background: #fef3c7;
            color: #b45309;
        }

        .type-badge.x_ray {
            background: #e0f2fe;
            color: #0369a1;
        }

        .type-badge.surgery {
            background: #fce7f3;
            color: #be185d;
        }

        .type-badge.vaccination {
            background: #ecfdf5;
            color: #059669;
        }

        .type-badge.other {
            background: #f3f4f6;
            color: #4b5563;
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

        .status-badge.archived {
            background: #f3f4f6;
            color: #6b7280;
        }

        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .attachment-link {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 12.5px;
            color: #6366f1;
            text-decoration: none;
            font-weight: 500;
        }

        .attachment-link:hover {
            text-decoration: underline;
        }

        .attachment-none {
            color: #d1d5db;
            font-size: 12.5px;
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
            .medical-records-page-title {
                align-items: flex-start;
            }

            .btn-new-record {
                width: 100%;
                justify-content: center;
            }

            .medical-records-card-header {
                padding: 16px;
            }

            .medical-records-table thead th,
            .medical-records-table tbody td {
                padding: 12px 14px;
            }
        }
    </style>

    <main class="content">

        <!-- Page Header -->
        <div class="medical-records-page-title">
            <div>
                <h1>All Medical Records</h1>
                <p>Manage patient medical records</p>
            </div>

            <a href="{{ route('medicalRecord.create') }}" class="btn-new-record">
                <i class="fas fa-plus"></i>
                Add Medical Record
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


        <!-- Medical Records Card -->
        <div class="medical-records-card">

            <!-- Card Header -->
            <div class="medical-records-card-header">
                <h3>
                    <i class="fas fa-file-medical" style="margin-right: 7px; color:#6366f1;"></i>
                    Medical Records
                </h3>

                <span class="medical-records-count-badge">
                    {{ $medicalRecords->count() }} total
                </span>
            </div>


            <!-- Table -->
            <div class="medical-records-table-wrap">

                <table class="medical-records-table">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Patient</th>
                            <th>Doctor</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Attachment</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>


                    <tbody>

                        @forelse($medicalRecords as $record)
                            <tr>

                                <!-- ID -->
                                <td>
                                    <span class="code-badge">
                                        #{{ $record->id }}
                                    </span>
                                </td>


                                <!-- Title -->
                                <td>
                                    <div class="record-cell">
                                        <strong>{{ $record->title }}</strong>
                                        @if($record->description)
                                            <span>{{ Str::limit($record->description, 40) }}</span>
                                        @endif
                                    </div>
                                </td>


                                <!-- Patient -->
                                <td>
                                    {{ $record->patient->user->name ?? '—' }}
                                </td>


                                <!-- Doctor -->
                                <td>
                                    {{ $record->doctor->user->name ?? '—' }}
                                </td>


                                <!-- Type -->
                                <td>
                                    <span class="type-badge {{ $record->record_type }}">
                                        @switch($record->record_type)
                                            @case('consultation')
                                                <i class="fas fa-stethoscope"></i>
                                                @break
                                            @case('lab_report')
                                                <i class="fas fa-flask"></i>
                                                @break
                                            @case('x_ray')
                                                <i class="fas fa-x-ray"></i>
                                                @break
                                            @case('surgery')
                                                <i class="fas fa-syringe"></i>
                                                @break
                                            @case('vaccination')
                                                <i class="fas fa-syringe"></i>
                                                @break
                                            @default
                                                <i class="fas fa-file-medical"></i>
                                        @endswitch

                                        {{ str_replace('_', ' ', $record->record_type) }}
                                    </span>
                                </td>


                                <!-- Date -->
                                <td>
                                    {{ $record->record_date ? \Carbon\Carbon::parse($record->record_date)->format('d M Y') : '—' }}
                                </td>


                                <!-- Attachment -->
                                <td>
                                    @if($record->attachment)
                                        <a href="{{ asset('medicalimage/' . $record->attachment) }}" target="_blank" class="attachment-link">
                                            <i class="fas fa-paperclip"></i>
                                            View
                                        </a>
                                    @else
                                        <span class="attachment-none">—</span>
                                    @endif
                                </td>


                                <!-- Status -->
                                <td>
                                    <span class="status-badge {{ $record->status }}">
                                        <span class="status-dot"></span>
                                        {{ $record->status }}
                                    </span>
                                </td>


                                <!-- Actions -->
                                <td class="action-icons">

                                    <!-- Show -->
                                    <a href="{{ route('medicalRecord.show', $record->id) }}" title="Show Record">
                                        <i class="fas fa-eye" style="color:#6366f1;"></i>
                                    </a>

                                    <!-- Edit -->
                                    <a href="{{ route('medicalRecord.edit', $record->id) }}" title="Edit Record">
                                        <i class="fas fa-pen" style="color:#6366f1;"></i>
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('medicalRecord.destroy', $record->id) }}" method="POST"
                                        style="display:inline;"
                                        onsubmit="return confirm('Are you sure you want to delete this medical record?');">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" title="Delete Record">
                                            <i class="fas fa-trash" style="color:#dc2626;"></i>
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="9">

                                    <div class="empty-state">

                                        <i class="fas fa-file-medical"></i>

                                        <h4>No Medical Records Found</h4>

                                        <p>
                                            No medical records have been added yet.
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
