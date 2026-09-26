@extends('layouts.admin')

@section('title', 'Add Medicine')

@section('content')

    <style>
        .department-form-wrap {
            max-width: 900px;
            margin: 0 auto;
        }

        .department-form-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.06);
            border: 1px solid #eef0f4;
            overflow: hidden;
        }

        .department-form-header {
            padding: 22px 24px;
            border-bottom: 1px solid #eef0f4;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        }

        .department-form-header h2 {
            color: #fff;
            font-size: 19px;
            font-weight: 700;
            margin: 0;
        }

        .department-form-header p {
            color: rgba(255, 255, 255, 0.85);
            font-size: 13px;
            margin: 4px 0 0;
        }

        .department-form-body {
            padding: 26px;
        }

        .field {
            margin-bottom: 20px;
        }

        .field label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 7px;
        }

        .field .req {
            color: #ef4444;
        }

        .field .hint {
            color: #9ca3af;
            font-weight: 400;
        }

        .field .form-control,
        .field select,
        .field textarea {
            width: 100%;
            padding: 11px 14px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            color: #111827;
            background: #fff;
            font-family: inherit;
            box-sizing: border-box;
        }

        .field textarea {
            resize: vertical;
            min-height: 90px;
        }

        .field .form-control:focus,
        .field select:focus,
        .field textarea:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
        }

        .field .text-danger {
            display: block;
            color: #ef4444;
            font-size: 12.5px;
            margin-top: 6px;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
        }

        .form-row .field {
            flex: 1 1 calc(33.333% - 11px);
            min-width: 180px;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 8px;
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
            padding: 11px 26px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 14.5px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-submit:hover {
            opacity: 0.92;
        }
    </style>

    <main class="content">

        <!-- ========== PAGE TITLE ========== -->
        <div class="page-title">

            <div>
                <h1>Add Medicine</h1>
                <p>Add a new medicine to the pharmacy inventory.</p>
            </div>

        </div>


        <!-- ========== FORM ========== -->
        <div class="department-form-wrap">

            <div class="department-form-card">


                <!-- ========== HEADER ========== -->
                <div class="department-form-header">

                    <h2>New Medicine</h2>

                    <p>Fill in the details below to add a new medicine.</p>

                </div>


                <!-- ========== BODY ========== -->
                <div class="department-form-body">

                    <form action="{{ route('medicines.store') }}" method="POST">

                        @csrf


                        <!-- NAME + GENERIC NAME + CATEGORY -->
                        <div class="form-row">

                            <div class="field">

                                <label for="name">
                                    Medicine Name <span class="req">*</span>
                                </label>

                                <input type="text" id="name" name="name" class="form-control"
                                    value="{{ old('name') }}" placeholder="e.g. Paracetamol 500mg">

                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="field">

                                <label for="generic_name">
                                    Generic Name
                                    
                                </label>

                                <input type="text" id="generic_name" name="generic_name" class="form-control"
                                    value="{{ old('generic_name') }}" placeholder="e.g. Acetaminophen">

                                @error('generic_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="field">

                                <label for="category">
                                    Category
                                    
                                </label>

                                <select id="category" name="category">

                                    <option value="">Select Category</option>

                                    @php
                                        $categories = ['Tablet', 'Capsule', 'Syrup', 'Injection', 'Ointment', 'Drops', 'Inhaler', 'Other'];
                                    @endphp

                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>
                                            {{ $cat }}
                                        </option>
                                    @endforeach

                                </select>

                                @error('category')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                        </div>


                        <!-- MANUFACTURER + UNIT + PRICE -->
                        <div class="form-row">

                            <div class="field">

                                <label for="manufacturer">
                                    Manufacturer
                                    
                                </label>

                                <input type="text" id="manufacturer" name="manufacturer" class="form-control"
                                    value="{{ old('manufacturer') }}" placeholder="e.g. Cipla Ltd.">

                                @error('manufacturer')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="field">

                                <label for="unit">
                                    Unit
                                    
                                </label>

                                <input type="text" id="unit" name="unit" class="form-control"
                                    value="{{ old('unit') }}" placeholder="e.g. strip, box, bottle">

                                @error('unit')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="field">

                                <label for="price">
                                    Price (₹) <span class="req">*</span>
                                </label>

                                <input type="number" id="price" name="price" class="form-control"
                                    value="{{ old('price') }}" placeholder="e.g. 25.00" step="0.01" min="0">

                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                        </div>


                        <!-- STOCK + EXPIRY + STATUS -->
                        <div class="form-row">

                            <div class="field">

                                <label for="stock_quantity">
                                    Stock Quantity <span class="req">*</span>
                                </label>

                                <input type="number" id="stock_quantity" name="stock_quantity" class="form-control"
                                    value="{{ old('stock_quantity') }}" placeholder="e.g. 100" min="0">

                                @error('stock_quantity')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="field">

                                <label for="expiry_date">
                                    Expiry Date
                                    
                                </label>

                                <input type="date" id="expiry_date" name="expiry_date" class="form-control"
                                    value="{{ old('expiry_date') }}">

                                @error('expiry_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="field">

                                <label for="status">
                                    Status <span class="req">*</span>
                                </label>

                                <select id="status" name="status">

                                    <option value="available" {{ old('status', 'available') == 'available' ? 'selected' : '' }}>
                                        Available
                                    </option>

                                    <option value="out_of_stock" {{ old('status') == 'out_of_stock' ? 'selected' : '' }}>
                                        Out of Stock
                                    </option>

                                    <option value="discontinued" {{ old('status') == 'discontinued' ? 'selected' : '' }}>
                                        Discontinued
                                    </option>

                                </select>

                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                        </div>


                        <!-- DESCRIPTION -->
                        <div class="field">

                            <label for="description">
                                Description
                                
                            </label>

                            <textarea id="description" name="description"
                                placeholder="Usage instructions, side effects, notes, etc.">{{ old('description') }}</textarea>

                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>


                        <!-- ACTIONS -->
                        <div class="form-actions">

                            <a href="{{ route('medicines.index') }}" class="btn-cancel">
                                Cancel
                            </a>

                            <button type="submit" class="btn-submit">
                                <i class="fas fa-plus"></i>
                                Create Medicine
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </main>

@endsection
