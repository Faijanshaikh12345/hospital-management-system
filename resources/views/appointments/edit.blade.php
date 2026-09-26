@extends('layouts.admin')

@section('title', 'Edit Appointment')

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
            min-height: 80px;
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
                <h1>Edit Appointment</h1>
                <p>Update this appointment's details.</p>
            </div>

        </div>


        <!-- ========== FORM ========== -->
        <div class="department-form-wrap">

            <div class="department-form-card">


                <!-- ========== HEADER ========== -->
                <div class="department-form-header">

                    <h2>Edit Appointment</h2>

                    <p>Update the details below and save changes.</p>

                </div>


                <!-- ========== BODY ========== -->
                <div class="department-form-body">

                    <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">

                        @csrf
                        @method('PUT')


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
                                            {{ old('patient_id', $appointment->patient_id) == $patient->id ? 'selected' : '' }}>
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
                                            {{ old('doctor_id', $appointment->doctor_id) == $doctor->id ? 'selected' : '' }}>
                                            {{ $doctor->user->name }}
                                        </option>
                                    @endforeach

                                </select>

                                @error('doctor_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                        </div>


                        <!-- DATE + TIME -->
                        <div class="form-row">

                            <div class="field">

                                <label for="appointment_date">
                                    Appointment Date <span class="req">*</span>
                                </label>

                                <input type="date" id="appointment_date" name="appointment_date" class="form-control"
                                    value="{{ old('appointment_date', $appointment->appointment_date) }}">

                                @error('appointment_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="field">

                                <label for="appointment_time">
                                    Appointment Time <span class="req">*</span>
                                </label>

                                <input type="time" id="appointment_time" name="appointment_time" class="form-control"
                                    value="{{ old('appointment_time', \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i')) }}">

                                @error('appointment_time')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                        </div>


                        <!-- STATUS -->
                        <div class="field">

                            <label for="status">
                                Status <span class="req">*</span>
                            </label>

                            <select id="status" name="status">

                                <option value="scheduled" {{ old('status', $appointment->status) == 'scheduled' ? 'selected' : '' }}>
                                    Scheduled
                                </option>

                                <option value="completed" {{ old('status', $appointment->status) == 'completed' ? 'selected' : '' }}>
                                    Completed
                                </option>

                                <option value="cancelled" {{ old('status', $appointment->status) == 'cancelled' ? 'selected' : '' }}>
                                    Cancelled
                                </option>

                            </select>

                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>


                        <!-- REASON -->
                        <div class="field">

                            <label for="reason">
                                Reason
                                
                            </label>

                            <textarea id="reason" name="reason">{{ old('reason', $appointment->reason) }}</textarea>

                            @error('reason')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>


                        <!-- NOTES -->
                        <div class="field">

                            <label for="notes">
                                Notes
                                
                            </label>

                            <textarea id="notes" name="notes">{{ old('notes', $appointment->notes) }}</textarea>

                            @error('notes')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>


                        <!-- ACTIONS -->
                        <div class="form-actions">

                            <a href="{{ route('appointments.index') }}" class="btn-cancel">
                                Cancel
                            </a>

                            <button type="submit" class="btn-submit">
                                <i class="fas fa-save"></i>
                                Update Appointment
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </main>

@endsection
