@extends('layouts.admin')

@section('title', 'Add Invoice')

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

        .field .form-control[readonly] {
            background: #f9fafb;
            color: #6b7280;
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

        .amount-note {
            background: #eef2ff;
            border: 1px solid #e0e7ff;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 12.5px;
            color: #4338ca;
            margin-bottom: 20px;
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
                <h1>Add Invoice</h1>
                <p>Create a new billing invoice for a patient.</p>
            </div>

        </div>


        <!-- ========== FORM ========== -->
        <div class="department-form-wrap">

            <div class="department-form-card">


                <!-- ========== HEADER ========== -->
                <div class="department-form-header">

                    <h2>New Invoice</h2>

                    <p>Fill in the details below to generate a bill.</p>

                </div>


                <!-- ========== BODY ========== -->
                <div class="department-form-body">

                    <form action="{{ route('billings.store') }}" method="POST">

                        @csrf


                        <div class="amount-note">
                            <i class="fas fa-info-circle"></i>
                            Total amount is calculated automatically as: Consultation Fee + Medicine Charges + Other Charges − Discount.
                        </div>


                        <!-- INVOICE NUMBER + PATIENT + DOCTOR -->
                        <div class="form-row">

                            <div class="field">

                                <label for="invoice_number_display">
                                    Invoice Number
                                </label>

                                <input type="text" id="invoice_number_display" class="form-control"
                                    value="{{ $invoiceNumber }}" readonly>

                            </div>

                            <div class="field">

                                <label for="patient_id">
                                    Patient <span class="req">*</span>
                                </label>

                                <select id="patient_id" name="patient_id">

                                    <option value="">Select Patient</option>

                                    @foreach ($patients as $patient)
                                        <option value="{{ $patient->id }}"
                                            {{ old('patient_id') == $patient->id ? 'selected' : '' }}>
                                            {{ $patient->user->name }}
                                        </option>
                                    @endforeach

                                </select>

                                @error('patient_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="field">

                                <label for="doctor_id">
                                    Doctor
                                    
                                </label>

                                <select id="doctor_id" name="doctor_id">

                                    <option value="">Select Doctor</option>

                                    @foreach ($doctors as $doctor)
                                        <option value="{{ $doctor->id }}"
                                            {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                            {{ $doctor->user->name }}
                                        </option>
                                    @endforeach

                                </select>

                                @error('doctor_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                        </div>


                        <!-- CONSULTATION FEE + MEDICINE CHARGES + OTHER CHARGES -->
                        <div class="form-row">

                            <div class="field">

                                <label for="consultation_fee">
                                    Consultation Fee (₹) <span class="req">*</span>
                                </label>

                                <input type="number" id="consultation_fee" name="consultation_fee" class="form-control"
                                    value="{{ old('consultation_fee', 0) }}" step="0.01" min="0">

                                @error('consultation_fee')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="field">

                                <label for="medicine_charges">
                                    Medicine Charges (₹) <span class="req">*</span>
                                </label>

                                <input type="number" id="medicine_charges" name="medicine_charges" class="form-control"
                                    value="{{ old('medicine_charges', 0) }}" step="0.01" min="0">

                                @error('medicine_charges')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="field">

                                <label for="other_charges">
                                    Other Charges (₹) <span class="req">*</span>
                                </label>

                                <input type="number" id="other_charges" name="other_charges" class="form-control"
                                    value="{{ old('other_charges', 0) }}" step="0.01" min="0">

                                @error('other_charges')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                        </div>


                        <!-- DISCOUNT + PAID AMOUNT + BILLING DATE -->
                        <div class="form-row">

                            <div class="field">

                                <label for="discount">
                                    Discount (₹)
                                    
                                </label>

                                <input type="number" id="discount" name="discount" class="form-control"
                                    value="{{ old('discount', 0) }}" step="0.01" min="0">

                                @error('discount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="field">

                                <label for="paid_amount">
                                    Paid Amount (₹) <span class="req">*</span>
                                </label>

                                <input type="number" id="paid_amount" name="paid_amount" class="form-control"
                                    value="{{ old('paid_amount', 0) }}" step="0.01" min="0">

                                @error('paid_amount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="field">

                                <label for="billing_date">
                                    Billing Date <span class="req">*</span>
                                </label>

                                <input type="date" id="billing_date" name="billing_date" class="form-control"
                                    value="{{ old('billing_date', date('Y-m-d')) }}">

                                @error('billing_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                        </div>


                        <!-- PAYMENT METHOD + STATUS -->
                        <div class="form-row">

                            <div class="field">

                                <label for="payment_method">
                                    Payment Method
                                    
                                </label>

                                <select id="payment_method" name="payment_method">

                                    <option value="">Select Method</option>

                                    @php
                                        $methods = [
                                            'cash' => 'Cash',
                                            'card' => 'Card',
                                            'upi' => 'UPI',
                                            'insurance' => 'Insurance',
                                            'other' => 'Other',
                                        ];
                                    @endphp

                                    @foreach ($methods as $value => $label)
                                        <option value="{{ $value }}"
                                            {{ old('payment_method') == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach

                                </select>

                                @error('payment_method')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="field">

                                <label for="status">
                                    Status <span class="req">*</span>
                                </label>

                                <select id="status" name="status">

                                    <option value="pending" {{ old('status', 'pending') == 'pending' ? 'selected' : '' }}>
                                        Pending
                                    </option>

                                    <option value="paid" {{ old('status') == 'paid' ? 'selected' : '' }}>
                                        Paid
                                    </option>

                                    <option value="partially_paid" {{ old('status') == 'partially_paid' ? 'selected' : '' }}>
                                        Partially Paid
                                    </option>

                                    <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>
                                        Cancelled
                                    </option>

                                </select>

                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                        </div>


                        <!-- NOTES -->
                        <div class="field">

                            <label for="notes">
                                Notes
                                
                            </label>

                            <textarea id="notes" name="notes"
                                placeholder="Any additional billing notes">{{ old('notes') }}</textarea>

                            @error('notes')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>


                        <!-- ACTIONS -->
                        <div class="form-actions">

                            <a href="{{ route('billings.index') }}" class="btn-cancel">
                                Cancel
                            </a>

                            <button type="submit" class="btn-submit">
                                <i class="fas fa-plus"></i>
                                Create Invoice
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </main>

@endsection
