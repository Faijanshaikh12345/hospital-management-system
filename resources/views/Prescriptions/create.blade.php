@extends('layouts.admin')

@section('title', 'Add Prescription')

@section('content')

    <style>
        .department-form-wrap {
            max-width: 700px;
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
            gap: 16px;
        }

        .form-row .field {
            flex: 1;
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
                <h1>Add Prescription</h1>
                <p>Create a new prescription record.</p>
            </div>

        </div>


        <!-- ========== FORM ========== -->
        <div class="department-form-wrap">

            <div class="department-form-card">


                <!-- ========== HEADER ========== -->
                <div class="department-form-header">

                    <h2>New Prescription</h2>

                    <p>Fill in the details below to add a new prescription.</p>

                </div>


                <!-- ========== BODY ========== -->
                <div class="department-form-body">

                    <form action="{{ route('prescriptions.store') }}" method="POST">

                        @csrf


                        <!-- PATIENT + DOCTOR -->
                        <div class="form-row">

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
                                    Doctor <span class="req">*</span>
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


                        <!-- APPOINTMENT + DATE -->
                        <div class="form-row">

                            <div class="field">

                                <label for="appointment_id">
                                    Appointment <span class="req">*</span>
                                </label>

                                <select id="appointment_id" name="appointment_id">

                                    <option value="">Select Appointment</option>

                                    @foreach ($appointments as $appointment)
                                        <option value="{{ $appointment->id }}"
                                            {{ old('appointment_id') == $appointment->id ? 'selected' : '' }}>
                                            #{{ $appointment->id }} —
                                            {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}
                                        </option>
                                    @endforeach

                                </select>

                                @error('appointment_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="field">

                                <label for="prescription_date">
                                    Prescription Date <span class="req">*</span>
                                </label>

                                <input type="date" id="prescription_date" name="prescription_date" class="form-control"
                                    value="{{ old('prescription_date') }}">

                                @error('prescription_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                        </div>


                        <!-- DIAGNOSIS -->
                        <div class="field">

                            <label for="diagnosis">
                                Diagnosis
                                
                            </label>

                            <textarea id="diagnosis" name="diagnosis"
                                placeholder="Patient's diagnosis">{{ old('diagnosis') }}</textarea>

                            @error('diagnosis')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>


                        <!-- NOTES -->
                        <div class="field">

                            <label for="notes">
                                Notes
                                
                            </label>

                            <textarea id="notes" name="notes"
                                placeholder="Any additional notes">{{ old('notes') }}</textarea>

                            @error('notes')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>


                        <!-- STATUS -->
                        <div class="field">

                            <label for="status">
                                Status <span class="req">*</span>
                            </label>

                            <select id="status" name="status">

                                <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                    Inactive
                                </option>

                            </select>

                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>


                        <!-- ACTIONS -->
                        <div class="form-actions">

                            <a href="{{ route('prescriptions.index') }}" class="btn-cancel">
                                Cancel
                            </a>

                            <button type="submit" class="btn-submit">
                                <i class="fas fa-plus"></i>
                                Create Prescription
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </main>

@endsection
