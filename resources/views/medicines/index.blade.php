@extends('layouts.admin')

@section('title', 'All Medicines')

@section('content')

    <style>
        .medicines-page-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 22px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .medicines-page-title h1 {
            font-size: 22px;
            font-weight: 700;
            color: #1f2937;
            margin: 0;
        }

        .medicines-page-title p {
            color: #6b7280;
            font-size: 13.5px;
            margin: 4px 0 0;
        }

        .btn-new-medicine {
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

        .btn-new-medicine:hover {
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

        .medicines-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.06);
            border: 1px solid #eef0f4;
            overflow: hidden;
        }

        .medicines-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 24px;
            border-bottom: 1px solid #eef0f4;
        }

        .medicines-card-header h3 {
            font-size: 16px;
            font-weight: 700;
            color: #1f2937;
            margin: 0;
        }

        .medicines-count-badge {
            background: #eef2ff;
            color: #4f46e5;
            font-size: 12.5px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 20px;
        }

        .medicines-table-wrap {
            overflow-x: auto;
        }

        .medicines-table {
            width: 100%;
            border-collapse: collapse;
        }

        .medicines-table thead th {
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

        .medicines-table tbody td {
            padding: 14px 20px;
            font-size: 14px;
            color: #374151;
            border-bottom: 1px solid #f1f2f6;
            vertical-align: middle;
            white-space: nowrap;
        }

        .medicines-table tbody tr:last-child td {
            border-bottom: none;
        }

        .medicines-table tbody tr:hover {
            background: #fafaff;
        }

        .medicine-cell strong {
            display: block;
            color: #1f2937;
            font-size: 13.5px;
        }

        .medicine-cell span {
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
            font-weight: 600;
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
            .medicines-page-title {
                align-items: flex-start;
            }

            .btn-new-medicine {
                width: 100%;
                justify-content: center;
            }

            .medicines-card-header {
                padding: 16px;
            }

            .medicines-table thead th,
            .medicines-table tbody td {
                padding: 12px 14px;
            }
        }
    </style>

    <main class="content">

        <!-- Page Header -->
        <div class="medicines-page-title">
            <div>
                <h1>All Medicines</h1>
                <p>Manage pharmacy inventory</p>
            </div>

            <a href="{{ route('medicines.create') }}" class="btn-new-medicine">
                <i class="fas fa-plus"></i>
                Add Medicine
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


        <!-- Medicines Card -->
        <div class="medicines-card">

            <!-- Card Header -->
            <div class="medicines-card-header">
                <h3>
                    <i class="fas fa-pills" style="margin-right: 7px; color:#6366f1;"></i>
                    Pharmacy Inventory
                </h3>

                <span class="medicines-count-badge">
                    {{ $medicines->count() }} total
                </span>
            </div>


            <!-- Table -->
            <div class="medicines-table-wrap">

                <table class="medicines-table">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Medicine</th>
                            <th>Category</th>
                            <th>Manufacturer</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Expiry</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>


                    <tbody>

                        @forelse($medicines as $medicine)
                            <tr>

                                <!-- ID -->
                                <td>
                                    <span class="code-badge">
                                        #{{ $medicine->id }}
                                    </span>
                                </td>


                                <!-- Medicine -->
                                <td>
                                    <div class="medicine-cell">
                                        <strong>{{ $medicine->name }}</strong>
                                        @if($medicine->generic_name)
                                            <span>{{ $medicine->generic_name }}</span>
                                        @endif
                                    </div>
                                </td>


                                <!-- Category -->
                                <td>
                                    {{ $medicine->category ?? '—' }}
                                </td>


                                <!-- Manufacturer -->
                                <td>
                                    {{ $medicine->manufacturer ?? '—' }}
                                </td>


                                <!-- Price -->
                                <td>
                                    ₹{{ number_format($medicine->price, 2) }}
                                    @if($medicine->unit)
                                        <span style="color:#9ca3af; font-size:12px;">/ {{ $medicine->unit }}</span>
                                    @endif
                                </td>


                                <!-- Stock -->
                                <td>
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
                                </td>


                                <!-- Expiry -->
                                <td>
                                    @if($medicine->expiry_date)
                                        <span class="{{ $medicine->expiry_date->isPast() ? 'expiry-warning' : '' }}">
                                            {{ $medicine->expiry_date->format('d M Y') }}
                                        </span>
                                    @else
                                        —
                                    @endif
                                </td>


                                <!-- Status -->
                                <td>
                                    <span class="status-badge {{ $medicine->status }}">
                                        <span class="status-dot"></span>
                                        {{ str_replace('_', ' ', $medicine->status) }}
                                    </span>
                                </td>


                                <!-- Actions -->
                                <td class="action-icons">

                                    <!-- Show -->
                                    <a href="{{ route('medicines.show', $medicine->id) }}" title="Show Medicine">
                                        <i class="fas fa-eye" style="color:#6366f1;"></i>
                                    </a>

                                    <!-- Edit -->
                                    <a href="{{ route('medicines.edit', $medicine->id) }}" title="Edit Medicine">
                                        <i class="fas fa-pen" style="color:#6366f1;"></i>
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('medicines.destroy', $medicine->id) }}" method="POST"
                                        style="display:inline;"
                                        onsubmit="return confirm('Are you sure you want to delete this medicine?');">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" title="Delete Medicine">
                                            <i class="fas fa-trash" style="color:#dc2626;"></i>
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="9">

                                    <div class="empty-state">

                                        <i class="fas fa-pills"></i>

                                        <h4>No Medicines Found</h4>

                                        <p>
                                            No medicines have been added yet.
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
