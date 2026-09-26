@extends('layouts.admin')

@section('title', 'All Departments')

@section('content')

    <style>
        .departments-page-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 22px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .departments-page-title h1 {
            font-size: 22px;
            font-weight: 700;
            color: #1f2937;
            margin: 0;
        }

        .departments-page-title p {
            color: #6b7280;
            font-size: 13.5px;
            margin: 4px 0 0;
        }

        .btn-new-department {
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

        .btn-new-department:hover {
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

        .departments-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.06);
            border: 1px solid #eef0f4;
            overflow: hidden;
        }

        .departments-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 24px;
            border-bottom: 1px solid #eef0f4;
        }

        .departments-card-header h3 {
            font-size: 16px;
            font-weight: 700;
            color: #1f2937;
            margin: 0;
        }

        .departments-count-badge {
            background: #eef2ff;
            color: #4f46e5;
            font-size: 12.5px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 20px;
        }

        .departments-table-wrap {
            overflow-x: auto;
        }

        .departments-table {
            width: 100%;
            border-collapse: collapse;
        }

        .departments-table thead th {
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

        .departments-table tbody td {
            padding: 14px 20px;
            font-size: 14px;
            color: #374151;
            border-bottom: 1px solid #f1f2f6;
            vertical-align: middle;
        }

        .departments-table tbody tr:last-child td {
            border-bottom: none;
        }

        .departments-table tbody tr:hover {
            background: #fafaff;
        }

        .department-cell strong {
            display: block;
            color: #1f2937;
            font-size: 13.5px;
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

        .description-cell {
            max-width: 280px;
            white-space: normal;
            color: #6b7280;
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
            .departments-page-title {
                align-items: flex-start;
            }

            .btn-new-department {
                width: 100%;
                justify-content: center;
            }

            .departments-card-header {
                padding: 16px;
            }

            .departments-table thead th,
            .departments-table tbody td {
                padding: 12px 14px;
            }
        }
    </style>

    <main class="content">

        <!-- Page Header -->
        <div class="departments-page-title">
            <div>
                <h1>All Departments</h1>
                <p>Manage hospital departments</p>
            </div>

            <a href="{{ route('departments.create') }}" class="btn-new-department">
                <i class="fas fa-plus"></i>
                Add Department
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


        <!-- Departments Card -->
        <div class="departments-card">

            <!-- Card Header -->
            <div class="departments-card-header">
                <h3>
                    <i class="fas fa-building" style="margin-right: 7px; color:#6366f1;"></i>
                    Hospital Departments
                </h3>

                <span class="departments-count-badge">
                    {{ $departments->count() }} total
                </span>
            </div>


            <!-- Table -->
            <div class="departments-table-wrap">

                <table class="departments-table">

                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>


                    <tbody>

                        @forelse($departments as $department)
                            <tr>

                                <!-- Name -->
                                <td>
                                    <div class="department-cell">
                                        <strong>
                                            {{ $department->name }}
                                        </strong>
                                    </div>
                                </td>


                                <!-- Code -->
                                <td>
                                    <span class="code-badge">
                                        {{ $department->code }}
                                    </span>
                                </td>


                                <!-- Description -->
                                <td class="description-cell">
                                    {{ $department->description ?? '—' }}
                                </td>


                                <!-- Status -->
                                <td>

                                    <span class="status-badge {{ strtolower($department->status) }}">

                                        <span class="status-dot"></span>

                                        {{ $department->status }}

                                    </span>

                                </td>


                                <!-- Created -->
                                <td>
                                    {{ $department->created_at ? $department->created_at->format('d M Y') : '—' }}
                                </td>


                                <!-- Actions -->
                                <td class="action-icons">

                                    <!-- Edit -->
                                    <a href="{{ route('departments.show', $department->id) }}" title="Show Department">
                                        <i class="fas fa-eye" style="color:#6366f1;"></i>
                                    </a>

                                    <!-- Edit -->
                                    <a href="{{ route('departments.edit', $department->id) }}" title="Edit Department">
                                        <i class="fas fa-pen" style="color:#6366f1;"></i>
                                    </a>



                                    <!-- Delete -->
                                    <form action="{{ route('departments.destroy', $department->id) }}" method="POST"
                                        style="display:inline;"
                                        onsubmit="return confirm('Are you sure you want to delete this department?');">

                                        @csrf

                                        @method('DELETE')

                                        <button type="submit" title="Delete Department">
                                            <i class="fas fa-trash" style="color:#dc2626;"></i>
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="6">

                                    <div class="empty-state">

                                        <i class="fas fa-building"></i>

                                        <h4>No Departments Found</h4>

                                        <p>
                                            No hospital departments have been added yet.
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
