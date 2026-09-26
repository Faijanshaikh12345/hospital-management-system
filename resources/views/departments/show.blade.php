@extends('layouts.admin')

@section('title', 'Department Details')

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
        min-width: 140px;
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
        <h1>Department Details</h1>
        <p>View full information for this department.</p>
    </div>

</div>


<!-- ========== SHOW CARD ========== -->
<div class="department-show-wrap">

    <div class="department-show-card">


        <!-- ========== HEADER ========== -->
        <div class="department-show-header">

            <div>
                <h2>{{ $department->name }}</h2>
                <p>Department Information</p>
            </div>

            <span class="code-badge">
                {{ $department->code }}
            </span>

        </div>


        <!-- ========== BODY ========== -->
        <div class="department-show-body">

            <!-- NAME -->
            <div class="detail-row">
                <span class="detail-label">Name</span>
                <span class="detail-value">{{ $department->name }}</span>
            </div>


            <!-- CODE -->
            <div class="detail-row">
                <span class="detail-label">Code</span>
                <span class="detail-value">
                    <span class="code-badge">{{ $department->code }}</span>
                </span>
            </div>


            <!-- DESCRIPTION -->
            <div class="detail-row">
                <span class="detail-label">Description</span>
                <span class="detail-value">{{ $department->description ?? '—' }}</span>
            </div>


            <!-- STATUS -->
            <div class="detail-row">
                <span class="detail-label">Status</span>
                <span class="detail-value">
                    <span class="status-badge {{ strtolower($department->status) }}">
                        <span class="status-dot"></span>
                        {{ $department->status }}
                    </span>
                </span>
            </div>


            <!-- CREATED -->
            <div class="detail-row">
                <span class="detail-label">Created</span>
                <span class="detail-value">
                    {{ $department->created_at ? $department->created_at->format('d M Y, h:i A') : '—' }}
                </span>
            </div>


            <!-- UPDATED -->
            <div class="detail-row">
                <span class="detail-label">Last Updated</span>
                <span class="detail-value">
                    {{ $department->updated_at ? $department->updated_at->format('d M Y, h:i A') : '—' }}
                </span>
            </div>


            <!-- ACTIONS -->
            <div class="form-actions">

                <a
                    href="{{ route('departments.index') }}"
                    class="btn-cancel"
                >
                    Back
                </a>

                <a
                    href="{{ route('departments.edit', $department->id) }}"
                    class="btn-submit"
                >
                    <i class="fas fa-pen"></i>
                    Edit Department
                </a>

            </div>

        </div>

    </div>

</div>

</main>

@endsection
