@extends('layouts.admin')

@section('title', 'All Invoices')

@section('content')

    <style>
        .billings-page-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 22px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .billings-page-title h1 {
            font-size: 22px;
            font-weight: 700;
            color: #1f2937;
            margin: 0;
        }

        .billings-page-title p {
            color: #6b7280;
            font-size: 13.5px;
            margin: 4px 0 0;
        }

        .btn-new-billing {
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

        .btn-new-billing:hover {
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

        .billings-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.06);
            border: 1px solid #eef0f4;
            overflow: hidden;
        }

        .billings-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 24px;
            border-bottom: 1px solid #eef0f4;
        }

        .billings-card-header h3 {
            font-size: 16px;
            font-weight: 700;
            color: #1f2937;
            margin: 0;
        }

        .billings-count-badge {
            background: #eef2ff;
            color: #4f46e5;
            font-size: 12.5px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 20px;
        }

        .billings-table-wrap {
            overflow-x: auto;
        }

        .billings-table {
            width: 100%;
            border-collapse: collapse;
        }

        .billings-table thead th {
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

        .billings-table tbody td {
            padding: 14px 20px;
            font-size: 14px;
            color: #374151;
            border-bottom: 1px solid #f1f2f6;
            vertical-align: middle;
            white-space: nowrap;
        }

        .billings-table tbody tr:last-child td {
            border-bottom: none;
        }

        .billings-table tbody tr:hover {
            background: #fafaff;
        }

        .billing-cell strong {
            display: block;
            color: #1f2937;
            font-size: 13.5px;
        }

        .billing-cell span {
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

        .balance-due {
            color: #dc2626;
            font-weight: 700;
        }

        .balance-clear {
            color: #059669;
            font-weight: 600;
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
            .billings-page-title {
                align-items: flex-start;
            }

            .btn-new-billing {
                width: 100%;
                justify-content: center;
            }

            .billings-card-header {
                padding: 16px;
            }

            .billings-table thead th,
            .billings-table tbody td {
                padding: 12px 14px;
            }
        }
    </style>

    <main class="content">

        <!-- Page Header -->
        <div class="billings-page-title">
            <div>
                <h1>All Invoices</h1>
                <p>Manage patient billing and payments</p>
            </div>

            <a href="{{ route('billings.create') }}" class="btn-new-billing">
                <i class="fas fa-plus"></i>
                Add Invoice
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


        <!-- Billings Card -->
        <div class="billings-card">

            <!-- Card Header -->
            <div class="billings-card-header">
                <h3>
                    <i class="fas fa-file-invoice-dollar" style="margin-right: 7px; color:#6366f1;"></i>
                    Patient Invoices
                </h3>

                <span class="billings-count-badge">
                    {{ $billings->count() }} total
                </span>
            </div>


            <!-- Table -->
            <div class="billings-table-wrap">

                <table class="billings-table">

                    <thead>
                        <tr>
                            <th>Invoice #</th>
                            <th>Patient</th>
                            <th>Doctor</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Paid</th>
                            <th>Balance</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>


                    <tbody>

                        @forelse($billings as $billing)
                            <tr>

                                <!-- Invoice Number -->
                                <td>
                                    <span class="code-badge">
                                        {{ $billing->invoice_number }}
                                    </span>
                                </td>


                                <!-- Patient -->
                                <td>
                                    <div class="billing-cell">
                                        <strong>{{ $billing->patient->user->name ?? '—' }}</strong>
                                    </div>
                                </td>


                                <!-- Doctor -->
                                <td>
                                    {{ $billing->doctor->user->name ?? '—' }}
                                </td>


                                <!-- Date -->
                                <td>
                                    {{ $billing->billing_date ? $billing->billing_date->format('d M Y') : '—' }}
                                </td>


                                <!-- Total -->
                                <td>
                                    ₹{{ number_format($billing->total_amount, 2) }}
                                </td>


                                <!-- Paid -->
                                <td>
                                    ₹{{ number_format($billing->paid_amount, 2) }}
                                </td>


                                <!-- Balance -->
                                <td>
                                    @php $balance = $billing->total_amount - $billing->paid_amount; @endphp
                                    <span class="{{ $balance > 0 ? 'balance-due' : 'balance-clear' }}">
                                        ₹{{ number_format($balance, 2) }}
                                    </span>
                                </td>


                                <!-- Status -->
                                <td>
                                    <span class="status-badge {{ $billing->status }}">
                                        <span class="status-dot"></span>
                                        {{ str_replace('_', ' ', $billing->status) }}
                                    </span>
                                </td>


                                <!-- Actions -->
                                <td class="action-icons">

                                    <!-- Show -->
                                    <a href="{{ route('billings.show', $billing->id) }}" title="Show Invoice">
                                        <i class="fas fa-eye" style="color:#6366f1;"></i>
                                    </a>

                                    <!-- Edit -->
                                    <a href="{{ route('billings.edit', $billing->id) }}" title="Edit Invoice">
                                        <i class="fas fa-pen" style="color:#6366f1;"></i>
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('billings.destroy', $billing->id) }}" method="POST"
                                        style="display:inline;"
                                        onsubmit="return confirm('Are you sure you want to delete this invoice?');">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" title="Delete Invoice">
                                            <i class="fas fa-trash" style="color:#dc2626;"></i>
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="9">

                                    <div class="empty-state">

                                        <i class="fas fa-file-invoice-dollar"></i>

                                        <h4>No Invoices Found</h4>

                                        <p>
                                            No billing records have been created yet.
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
