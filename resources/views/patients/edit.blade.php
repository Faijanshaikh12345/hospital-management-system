@extends('layouts.admin')

@section('title', 'Edit Patient')

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
                <h1>Edit Patient</h1>
                <p>Update record for {{ $patient->user->name }}.</p>
            </div>

        </div>


        <!-- ========== FORM ========== -->
        <div class="department-form-wrap">

            <div class="department-form-card">


                <!-- ========== HEADER ========== -->
                <div class="department-form-header">

                    <h2>Edit Patient</h2>

                    <p>Update the details below and save changes.</p>

                </div>


                <!-- ========== BODY ========== -->
                <div class="department-form-body">

                    <form action="{{ route('patients.update', $patient->id) }}" method="POST">

                        @csrf
                        @method('PUT')


                        <!-- NAME + PATIENT ID + DATE OF BIRTH -->
                        <div class="form-row">

                            <div class="field">

                                <label for="name">
                                    Patient Name <span class="req">*</span>
                                </label>

                                <input type="text" id="name" name="name" class="form-control"
                                    value="{{ old('name', $patient->user->name) }}" placeholder="e.g. Rahul Sharma">

                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="field">

                                <label for="patient_id">
                                    Patient ID <span class="req">*</span>
                                </label>

                                <input type="text" id="patient_id" name="patient_id" class="form-control"
                                    value="{{ old('patient_id', $patient->patient_id) }}" placeholder="e.g. PT-0001">

                                @error('patient_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="field">

                                <label for="date_of_birth">
                                    Date of Birth <span class="req">*</span>
                                </label>

                                <input type="date" id="date_of_birth" name="date_of_birth" class="form-control"
                                    value="{{ old('date_of_birth', $patient->date_of_birth) }}">

                                @error('date_of_birth')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                        </div>


                        <!-- GENDER + PHONE + EMAIL -->
                        <div class="form-row">

                            <div class="field">

                                <label for="gender">
                                    Gender <span class="req">*</span>
                                </label>

                                <select id="gender" name="gender">

                                    <option value="">Select Gender</option>

                                    <option value="male" {{ old('gender', $patient->gender) == 'male' ? 'selected' : '' }}>
                                        Male
                                    </option>

                                    <option value="female" {{ old('gender', $patient->gender) == 'female' ? 'selected' : '' }}>
                                        Female
                                    </option>

                                    <option value="other" {{ old('gender', $patient->gender) == 'other' ? 'selected' : '' }}>
                                        Other
                                    </option>

                                </select>

                                @error('gender')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="field">

                                <label for="phone">
                                    Phone Number <span class="req">*</span>
                                </label>

                                <input type="text" id="phone" name="phone" class="form-control"
                                    value="{{ old('phone', $patient->user->phone) }}" placeholder="e.g. 9876543210">

                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="field">

                                <label for="email">
                                    Email
                                    
                                </label>

                                <input type="email" id="email" name="email" class="form-control"
                                    value="{{ old('email', $patient->user->email) }}" placeholder="e.g. rahul@example.com">

                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                        </div>

                        <!-- PASSWORD + DOCTOR + BLOOD GROUP -->
                        <div class="form-row">

                            <div class="field">

                                <label for="password">
                                    Password
                                    <span class="hint">(leave blank to keep current)</span>
                                </label>

                                <input type="password" id="password" name="password" class="form-control"
                                    value="" placeholder="e.g rahul@123">

                                @error('password')
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
                                            {{ old('doctor_id', $patient->doctor_id) == $doctor->id ? 'selected' : '' }}>
                                            {{ $doctor->user->name }} ({{ $doctor->department->name ?? 'No Department' }})
                                        </option>
                                    @endforeach

                                </select>

                                @error('doctor_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="field">

                                <label for="blood_group">
                                    Blood Group
                                    
                                </label>

                                <select id="blood_group" name="blood_group">

                                    <option value="">Select Blood Group</option>

                                    @foreach (['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $group)
                                        <option value="{{ $group }}"
                                            {{ old('blood_group', $patient->blood_group) == $group ? 'selected' : '' }}>
                                            {{ $group }}
                                        </option>
                                    @endforeach

                                </select>

                                @error('blood_group')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                        </div>


                        <!-- EMERGENCY CONTACT + EMERGENCY CONTACT NAME + STATUS -->
                        <div class="form-row">

                            <div class="field">

                                <label for="emergency_contact">
                                    Emergency Contact Number
                                    
                                </label>

                                <input type="text" id="emergency_contact" name="emergency_contact"
                                    class="form-control" value="{{ old('emergency_contact', $patient->emergency_contact) }}"
                                    placeholder="e.g. 9876543210">

                                @error('emergency_contact')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="field">

                                <label for="emergency_contact_name">
                                    Emergency Contact Name
                                    
                                </label>

                                <input type="text" id="emergency_contact_name" name="emergency_contact_name"
                                    class="form-control" value="{{ old('emergency_contact_name', $patient->emergency_contact_name) }}"
                                    placeholder="e.g. Sunita Sharma">

                                @error('emergency_contact_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="field">

                                <label for="status">
                                    Status <span class="req">*</span>
                                </label>

                                <select id="status" name="status">

                                    <option value="active" {{ old('status', $patient->status) == 'active' ? 'selected' : '' }}>
                                        Active
                                    </option>

                                    <option value="inactive" {{ old('status', $patient->status) == 'inactive' ? 'selected' : '' }}>
                                        Inactive
                                    </option>

                                </select>

                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                        </div>


                        <!-- ADDRESS -->
                        <div class="field">

                            <label for="address">
                                Address
                                
                            </label>

                            <textarea id="address" name="address" placeholder="Full residential address">{{ old('address', $patient->address) }}</textarea>

                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>


                        <!-- MEDICAL HISTORY -->
                        <div class="field">

                            <label for="medical_history">
                                Medical History
                                
                            </label>

                            <textarea id="medical_history" name="medical_history" placeholder="Any past medical conditions or surgeries">{{ old('medical_history', $patient->medical_history) }}</textarea>

                            @error('medical_history')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>


                        <!-- ALLERGIES -->
                        <div class="field">

                            <label for="allergies">
                                Allergies
                                
                            </label>

                            <textarea id="allergies" name="allergies" placeholder="Any known allergies">{{ old('allergies', $patient->allergies) }}</textarea>

                            @error('allergies')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>


                        <!-- ACTIONS -->
                        <div class="form-actions">

                            <a href="{{ route('patients.index') }}" class="btn-cancel">
                                Cancel
                            </a>

                            <button type="submit" class="btn-submit">
                                <i class="fas fa-save"></i>
                                Update Patient
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </main>

@endsection
