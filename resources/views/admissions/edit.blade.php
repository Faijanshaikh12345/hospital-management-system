@extends('layouts.admin')

@section('title', 'Edit Admission')

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
                <h1>Edit Admission</h1>
                <p>Update details for this admission record.</p>
            </div>

        </div>


        <!-- ========== FORM ========== -->
        <div class="department-form-wrap">

            <div class="department-form-card">


                <!-- ========== HEADER ========== -->
                <div class="department-form-header">

                    <h2>Update Admission</h2>

                    <p>Modify the fields below and save your changes.</p>

                </div>


                <!-- ========== BODY ========== -->
                <div class="department-form-body">

                    <form action="{{ route('admissions.update', $admission->id) }}" method="POST">

                        @csrf
                        @method('PUT')


                        <!-- PATIENT + DOCTOR + STATUS -->
                        <div class="form-row">

                            <div class="field">

                                <label for="patient_id">
                                    Patient <span class="req">*</span>
                                </label>

                                <select id="patient_id" name="patient_id">

                                    <option value="">Select Patient</option>

                                    @foreach ($patients as $patient)
                                        <option value="{{ $patient->id }}"
                                            {{ old('patient_id', $admission->patient_id) == $patient->id ? 'selected' : '' }}>
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
                                            {{ old('doctor_id', $admission->doctor_id) == $doctor->id ? 'selected' : '' }}>
                                            {{ $doctor->user->name }}
                                        </option>
                                    @endforeach

                                </select>

                                @error('doctor_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="field">

                                <label for="status">
                                    Status <span class="req">*</span>
                                </label>

                                <select id="status" name="status">

                                    <option value="admitted"
                                        {{ old('status', $admission->status) == 'admitted' ? 'selected' : '' }}>
                                        Admitted
                                    </option>

                                    <option value="discharged"
                                        {{ old('status', $admission->status) == 'discharged' ? 'selected' : '' }}>
                                        Discharged
                                    </option>

                                    <option value="transferred"
                                        {{ old('status', $admission->status) == 'transferred' ? 'selected' : '' }}>
                                        Transferred
                                    </option>

                                </select>

                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                        </div>


                        <!-- WARD + BED + CHARGES -->
                        <div class="form-row">

                            <div class="field">

                                <label for="ward">
                                    Ward
                                    
                                </label>

                                <input type="text" id="ward" name="ward" class="form-control"
                                    value="{{ old('ward', $admission->ward) }}" placeholder="e.g. General, ICU, Maternity">

                                @error('ward')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="field">

                                <label for="bed_number">
                                    Bed Number
                                    
                                </label>

                                <input type="text" id="bed_number" name="bed_number" class="form-control"
                                    value="{{ old('bed_number', $admission->bed_number) }}" placeholder="e.g. B-12">

                                @error('bed_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="field">

                                <label for="total_charges">
                                    Total Charges (₹) <span class="req">*</span>
                                </label>

                                <input type="number" id="total_charges" name="total_charges" class="form-control"
                                    value="{{ old('total_charges', $admission->total_charges) }}"
                                    placeholder="e.g. 5000.00" step="0.01" min="0">

                                @error('total_charges')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                        </div>


                        <!-- ADMISSION DATE + DISCHARGE DATE -->
                        <div class="form-row">

                            <div class="field">

                                <label for="admission_date">
                                    Admission Date & Time <span class="req">*</span>
                                </label>

                                <input type="datetime-local" id="admission_date" name="admission_date"
                                    class="form-control"
                                    value="{{ old('admission_date', $admission->admission_date ? $admission->admission_date->format('Y-m-d\TH:i') : '') }}">

                                @error('admission_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="field">

                                <label for="discharge_date">
                                    Discharge Date & Time
                                    
                                </label>

                                <input type="datetime-local" id="discharge_date" name="discharge_date"
                                    class="form-control"
                                    value="{{ old('discharge_date', $admission->discharge_date ? $admission->discharge_date->format('Y-m-d\TH:i') : '') }}">

                                @error('discharge_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                        </div>


                        <!-- REASON -->
                        <div class="field">

                            <label for="reason">
                                Reason for Admission
                                
                            </label>

                            <textarea id="reason" name="reason"
                                placeholder="Why is the patient being admitted?">{{ old('reason', $admission->reason) }}</textarea>

                            @error('reason')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>


                        <!-- DIAGNOSIS -->
                        <div class="field">

                            <label for="diagnosis">
                                Diagnosis
                                
                            </label>

                            <textarea id="diagnosis" name="diagnosis"
                                placeholder="Diagnosis notes">{{ old('diagnosis', $admission->diagnosis) }}</textarea>

                            @error('diagnosis')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>


                        <!-- ACTIONS -->
                        <div class="form-actions">

                            <a href="{{ route('admissions.index') }}" class="btn-cancel">
                                Cancel
                            </a>

                            <button type="submit" class="btn-submit">
                                <i class="fas fa-save"></i>
                                Update Admission
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </main>

@endsection
