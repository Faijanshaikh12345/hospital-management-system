@extends('layouts.admin')

@section('title', 'Reports')

@section('content')

    <style>
        .reports-page-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 22px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .reports-page-title h1 {
            font-size: 22px;
            font-weight: 700;
            color: #1f2937;
            margin: 0;
        }

        .reports-page-title p {
            color: #6b7280;
            font-size: 13.5px;
            margin: 4px 0 0;
        }

        .btn-export {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            background: linear-gradient(135deg, #059669, #10b981);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: 0.2s;
        }

        .btn-export:hover {
            opacity: 0.92;
            color: #fff;
            transform: translateY(-1px);
        }

        /* ===== Summary Cards ===== */
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .summary-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.06);
            border: 1px solid #eef0f4;
            padding: 18px 20px;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .summary-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .summary-icon.blue { background: #eef2ff; color: #4f46e5; }
        .summary-icon.green { background: #ecfdf5; color: #059669; }
        .summary-icon.red { background: #fef2f2; color: #dc2626; }
        .summary-icon.yellow { background: #fef3c7; color: #b45309; }
        .summary-icon.purple { background: #f3e8ff; color: #7c3aed; }
        .summary-icon.cyan { background: #e0f2fe; color: #0369a1; }

        .summary-text h4 {
            margin: 0;
            font-size: 20px;
            font-weight: 700;
            color: #1f2937;
        }

        .summary-text p {
            margin: 2px 0 0;
            font-size: 12.5px;
            color: #6b7280;
        }

        /* ===== Filter Form ===== */
        .filter-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.06);
            border: 1px solid #eef0f4;
            padding: 20px 24px;
            margin-bottom: 20px;
        }

        .filter-form {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            align-items: flex-end;
        }

        .filter-field {
            flex: 1 1 180px;
            min-width: 160px;
        }

        .filter-field label {
            display: block;
            font-size: 12.5px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
        }

        .filter-field input,
        .filter-field select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 13.5px;
            color: #111827;
            background: #fff;
            box-sizing: border-box;
        }

        .filter-field input:focus,
        .filter-field select:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
        }

        .btn-filter {
            padding: 10px 20px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 13.5px;
            font-weight: 600;
            cursor: pointer;
            white-space: nowrap;
        }

        .btn-filter:hover {
            opacity: 0.92;
        }

        .btn-clear {
            padding: 10px 20px;
            background: #f3f4f6;
            color: #374151;
            border: none;
            border-radius: 8px;
            font-size: 13.5px;
            font-weight: 600;
            text-decoration: none;
            white-space: nowrap;
            display: inline-flex;
            align-items: center;
        }

        .btn-clear:hover {
            background: #e5e7eb;
        }

        /* ===== Table ===== */
        .reports-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.06);
            border: 1px solid #eef0f4;
            overflow: hidden;
        }

        .reports-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 24px;
            border-bottom: 1px solid #eef0f4;
        }

        .reports-card-header h3 {
            font-size: 16px;
            font-weight: 700;
            color: #1f2937;
            margin: 0;
        }

        .reports-count-badge {
            background: #eef2ff;
            color: #4f46e5;
            font-size: 12.5px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 20px;
        }

        .reports-table-wrap {
            overflow-x: auto;
        }

        .reports-table {
            width: 100%;
            border-collapse: collapse;
        }

        .reports-table thead th {
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

        .reports-table tbody td {
            padding: 14px 20px;
            font-size: 14px;
            color: #374151;
            border-bottom: 1px solid #f1f2f6;
            vertical-align: middle;
            white-space: nowrap;
        }

        .reports-table tbody tr:last-child td {
            border-bottom: none;
        }

        .reports-table tbody tr:hover {
            background: #fafaff;
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

        .status-badge.paid { background: #ecfdf5; color: #059669; }
        .status-badge.pending { background: #fef3c7; color: #b45309; }
        .status-badge.partially_paid { background: #e0f2fe; color: #0369a1; }
        .status-badge.cancelled { background: #fef2f2; color: #dc2626; }

        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
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
            .reports-page-title {
                align-items: flex-start;
            }

            .btn-export {
                width: 100%;
                justify-content: center;
            }

            .filter-form {
                flex-direction: column;
                align-items: stretch;
            }

            .reports-table thead th,
            .reports-table tbody td {
                padding: 12px 14px;
            }
        }
    </style>

    <main class="content">

        <!-- Page Header -->
        <div class="reports-page-title">
            <div>
                <h1>Reports</h1>
                <p>Overview and billing report for the hospital</p>
            </div>

            <a href="{{ route('reports.export', request()->query()) }}" class="btn-export">
                <i class="fas fa-file-excel"></i>
                Export to Excel
            </a>
        </div>


        <!-- ======= Summary Cards ======= -->
        <div class="summary-grid">

            <div class="summary-card">
                <div class="summary-icon blue"><i class="fas fa-user-injured"></i></div>
                <div class="summary-text">
                    <h4>{{ $totalPatients }}</h4>
                    <p>Total Patients</p>
                </div>
            </div>

            <div class="summary-card">
                <div class="summary-icon purple"><i class="fas fa-user-doctor"></i></div>
                <div class="summary-text">
                    <h4>{{ $totalDoctors }}</h4>
                    <p>Total Doctors</p>
                </div>
            </div>

            <div class="summary-card">
                <div class="summary-icon cyan"><i class="fas fa-calendar-check"></i></div>
                <div class="summary-text">
                    <h4>{{ $totalAppointments }}</h4>
                    <p>Total Appointments</p>
                </div>
            </div>

            <div class="summary-card">
                <div class="summary-icon green"><i class="fas fa-indian-rupee-sign"></i></div>
                <div class="summary-text">
                    <h4>₹{{ number_format($totalRevenue, 2) }}</h4>
                    <p>Total Revenue Collected</p>
                </div>
            </div>

            <div class="summary-card">
                <div class="summary-icon red"><i class="fas fa-hourglass-half"></i></div>
                <div class="summary-text">
                    <h4>₹{{ number_format($pendingRevenue, 2) }}</h4>
                    <p>Pending Revenue</p>
                </div>
            </div>

            <div class="summary-card">
                <div class="summary-icon blue"><i class="fas fa-bed"></i></div>
                <div class="summary-text">
                    <h4>{{ $activeAdmissions }}</h4>
                    <p>Currently Admitted</p>
                </div>
            </div>

            <div class="summary-card">
                <div class="summary-icon yellow"><i class="fas fa-exclamation-triangle"></i></div>
                <div class="summary-text">
                    <h4>{{ $lowStockMedicines }}</h4>
                    <p>Low Stock Medicines</p>
                </div>
            </div>

            <div class="summary-card">
                <div class="summary-icon red"><i class="fas fa-times-circle"></i></div>
                <div class="summary-text">
                    <h4>{{ $outOfStockMedicines }}</h4>
                    <p>Out of Stock Medicines</p>
                </div>
            </div>

        </div>


        <!-- ======= Filter Form ======= -->
        <div class="filter-card">

            <form method="GET" action="{{ route('reports.index') }}" class="filter-form">

                <div class="filter-field">
                    <label for="search">Search</label>
                    <input type="text" id="search" name="search" value="{{ request('search') }}"
                        placeholder="Invoice # or patient name">
                </div>

                <div class="filter-field">
                    <label for="status">Status</label>
                    <select id="status" name="status">
                        <option value="">All Statuses</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="partially_paid" {{ request('status') == 'partially_paid' ? 'selected' : '' }}>Partially Paid</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <div class="filter-field">
                    <label for="from_date">From Date</label>
                    <input type="date" id="from_date" name="from_date" value="{{ request('from_date') }}">
                </div>

                <div class="filter-field">
                    <label for="to_date">To Date</label>
                    <input type="date" id="to_date" name="to_date" value="{{ request('to_date') }}">
                </div>

                <button type="submit" class="btn-filter">
                    <i class="fas fa-filter"></i>
                    Apply Filters
                </button>

                <a href="{{ route('reports.index') }}" class="btn-clear">
                    Clear
                </a>

            </form>

        </div>


        <!-- ======= Billing Report Table ======= -->
        <div class="reports-card">

            <div class="reports-card-header">
                <h3>
                    <i class="fas fa-file-invoice-dollar" style="margin-right: 7px; color:#6366f1;"></i>
                    Billing Report
                </h3>

                <span class="reports-count-badge">
                    {{ $billings->count() }} records
                </span>
            </div>


            <div class="reports-table-wrap">

                <table class="reports-table">

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
                        </tr>
                    </thead>


                    <tbody>

                        @forelse($billings as $billing)
                            <tr>

                                <td>
                                    <span class="code-badge">{{ $billing->invoice_number }}</span>
                                </td>

                                <td>{{ $billing->patient->user->name ?? '—' }}</td>

                                <td>{{ $billing->doctor->user->name ?? '—' }}</td>

                                <td>{{ $billing->billing_date ? $billing->billing_date->format('d M Y') : '—' }}</td>

                                <td>₹{{ number_format($billing->total_amount, 2) }}</td>

                                <td>₹{{ number_format($billing->paid_amount, 2) }}</td>

                                <td>₹{{ number_format($billing->total_amount - $billing->paid_amount, 2) }}</td>

                                <td>
                                    <span class="status-badge {{ $billing->status }}">
                                        <span class="status-dot"></span>
                                        {{ str_replace('_', ' ', $billing->status) }}
                                    </span>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="8">
                                    <div class="empty-state">
                                        <i class="fas fa-file-invoice-dollar"></i>
                                        <h4>No Records Found</h4>
                                        <p>Try adjusting your filters.</p>
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
