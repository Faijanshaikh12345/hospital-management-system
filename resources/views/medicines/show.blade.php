@extends('layouts.admin')

@section('title', 'Medicine Details')

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

    .stock-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 12.5px;
        font-weight: 600;
        padding: 5px 10px;
        border-radius: 20px;
    }

    .stock-badge.stock-ok {
        background: #ecfdf5;
        color: #059669;
    }

    .stock-badge.stock-low {
        background: #fef3c7;
        color: #b45309;
    }

    .stock-badge.stock-zero {
        background: #fef2f2;
        color: #dc2626;
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

    .status-badge.available {
        background: #ecfdf5;
        color: #059669;
    }

    .status-badge.out_of_stock {
        background: #fef2f2;
        color: #dc2626;
    }

    .status-badge.discontinued {
        background: #f3f4f6;
        color: #6b7280;
    }

    .status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }

    .expiry-warning {
        color: #dc2626;
        font-weight: 700;
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
        <h1>Medicine Details</h1>
        <p>View full information for this medicine.</p>
    </div>

</div>


<!-- ========== SHOW CARD ========== -->
<div class="department-show-wrap">

    <div class="department-show-card">


        <!-- ========== HEADER ========== -->
        <div class="department-show-header">

            <div>
                <h2>{{ $medicine->name }}</h2>
                <p>Medicine Information</p>
            </div>

            <span class="code-badge">
                #{{ $medicine->id }}
            </span>

        </div>


        <!-- ========== BODY ========== -->
        <div class="department-show-body">

            <!-- NAME -->
            <div class="detail-row">
                <span class="detail-label">Medicine Name</span>
                <span class="detail-value">{{ $medicine->name }}</span>
            </div>


            <!-- GENERIC NAME -->
            <div class="detail-row">
                <span class="detail-label">Generic Name</span>
                <span class="detail-value">{{ $medicine->generic_name ?? '—' }}</span>
            </div>


            <!-- CATEGORY -->
            <div class="detail-row">
                <span class="detail-label">Category</span>
                <span class="detail-value">{{ $medicine->category ?? '—' }}</span>
            </div>


            <!-- MANUFACTURER -->
            <div class="detail-row">
                <span class="detail-label">Manufacturer</span>
                <span class="detail-value">{{ $medicine->manufacturer ?? '—' }}</span>
            </div>


            <!-- UNIT -->
            <div class="detail-row">
                <span class="detail-label">Unit</span>
                <span class="detail-value">{{ $medicine->unit ?? '—' }}</span>
            </div>


            <!-- PRICE -->
            <div class="detail-row">
                <span class="detail-label">Price</span>
                <span class="detail-value">₹{{ number_format($medicine->price, 2) }}</span>
            </div>


            <!-- STOCK -->
            <div class="detail-row">
                <span class="detail-label">Stock Quantity</span>
                <span class="detail-value">
                    @if($medicine->stock_quantity <= 0)
                        <span class="stock-badge stock-zero">
                            <i class="fas fa-times-circle"></i>
                            0 units
                        </span>
                    @elseif($medicine->stock_quantity <= 10)
                        <span class="stock-badge stock-low">
                            <i class="fas fa-exclamation-triangle"></i>
                            {{ $medicine->stock_quantity }} units
                        </span>
                    @else
                        <span class="stock-badge stock-ok">
                            <i class="fas fa-check-circle"></i>
                            {{ $medicine->stock_quantity }} units
                        </span>
                    @endif
                </span>
            </div>


            <!-- EXPIRY DATE -->
            <div class="detail-row">
                <span class="detail-label">Expiry Date</span>
                <span class="detail-value">
                    @if($medicine->expiry_date)
                        <span class="{{ $medicine->expiry_date->isPast() ? 'expiry-warning' : '' }}">
                            {{ $medicine->expiry_date->format('d M Y') }}
                            @if($medicine->expiry_date->isPast())
                                (Expired)
                            @endif
                        </span>
                    @else
                        —
                    @endif
                </span>
            </div>


            <!-- DESCRIPTION -->
            <div class="detail-row">
                <span class="detail-label">Description</span>
                <span class="detail-value description-value">
                    {{ $medicine->description ?? '—' }}
                </span>
            </div>


            <!-- STATUS -->
            <div class="detail-row">
                <span class="detail-label">Status</span>
                <span class="detail-value">
                    <span class="status-badge {{ $medicine->status }}">
                        <span class="status-dot"></span>
                        {{ str_replace('_', ' ', $medicine->status) }}
                    </span>
                </span>
            </div>


            <!-- CREATED -->
            <div class="detail-row">
                <span class="detail-label">Created</span>
                <span class="detail-value">
                    {{ $medicine->created_at ? $medicine->created_at->format('d M Y, h:i A') : '—' }}
                </span>
            </div>


            <!-- UPDATED -->
            <div class="detail-row">
                <span class="detail-label">Last Updated</span>
                <span class="detail-value">
                    {{ $medicine->updated_at ? $medicine->updated_at->format('d M Y, h:i A') : '—' }}
                </span>
            </div>


            <!-- ACTIONS -->
            <div class="form-actions">

                <a href="{{ route('medicines.index') }}" class="btn-cancel">
                    Back
                </a>

                <a href="{{ route('medicines.edit', $medicine->id) }}" class="btn-submit">
                    <i class="fas fa-pen"></i>
                    Edit Medicine
                </a>

            </div>

        </div>

    </div>

</div>

</main>

@endsection
