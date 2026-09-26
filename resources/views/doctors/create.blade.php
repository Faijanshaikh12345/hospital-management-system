@extends('layouts.admin')

@section('title', 'Add Doctor')

@section('content')

    <style>
        .department-form-wrap {
            max-width: 600px;
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
                <h1>Add Doctor</h1>
                <p>Create a new doctor record.</p>
            </div>

        </div>


        <!-- ========== FORM ========== -->
        <div class="department-form-wrap">

            <div class="department-form-card">


                <!-- ========== HEADER ========== -->
                <div class="department-form-header">

                    <h2>New Doctor</h2>

                    <p>Fill in the details below to add a new doctor.</p>

                </div>


                <!-- ========== BODY ========== -->
                <div class="department-form-body">

                    <form action="{{ route('doctors.store') }}" method="POST">

                        @csrf


                        <div class="form-row">
                            <!-- NAME -->
                            <div class="field">

                                <label for="name">
                                    Doctor Name <span class="req">*</span>
                                </label>

                                <input type="text" id="name" name="name" class="form-control"
                                    value="{{ old('name') }}" placeholder="e.g. Dr. Rahul Sharma">

                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                            <!-- PHONE -->
                            <div class="field">

                                <label for="phone">
                                    Phone Number <span class="req">*</span>
                                </label>

                                <input type="text" id="phone" name="phone" class="form-control"
                                    value="{{ old('phone') }}" placeholder="e.g. 9876543210">

                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>


                        <div class="form-row">
                            <!-- EMAIL -->
                            <div class="field">
                                <label for="email">
                                    Email <span class="req">*</span>
                                </label>

                                <input type="email" id="email" name="email" class="form-control"
                                    value="{{ old('email') }}" placeholder="e.g. rahul@example.com">

                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="field">
                                <label for="password">Password</label>

                                <input type="password" id="password" name="password" class="form-control" placeholder="e.g. Rahul@123">

                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>



                        </div>


                        <div class="form-row">
                            <!-- DEPARTMENT -->
                            <div class="field">

                                <label for="department_id">
                                    Department <span class="req">*</span>
                                </label>

                                <select id="department_id" name="department_id">

                                    <option value="">Select Department</option>

                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}"
                                            {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                            {{ $department->name }}
                                        </option>
                                    @endforeach

                                </select>

                                @error('department_id')
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
                        </div>


                        <div class="form-row">

                            <!-- SPECIALIZATION -->
                            <div class="field">

                                <label for="specialization">
                                    Specialization <span class="req">*</span>
                                </label>

                                <input type="text" id="specialization" name="specialization" class="form-control"
                                    value="{{ old('specialization') }}" placeholder="e.g. Cardiologist">

                                @error('specialization')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>


                            <!-- QUALIFICATION -->
                            <div class="field">

                                <label for="qualification">
                                    Qualification <span class="req">*</span>
                                </label>

                                <input type="text" id="qualification" name="qualification" class="form-control"
                                    value="{{ old('qualification') }}" placeholder="e.g. MBBS, MD">

                                @error('qualification')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>


                        <!-- EXPERIENCE & CONSULTATION FEE -->
                        <div class="form-row">

                            <!-- EXPERIENCE -->
                            <div class="field">

                                <label for="experience">
                                    Experience (years) <span class="req">*</span>
                                </label>

                                <input type="number" id="experience" name="experience" class="form-control"
                                    value="{{ old('experience') }}" placeholder="e.g. 5" min="0">

                                @error('experience')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>


                            <!-- CONSULTATION FEE -->
                            <div class="field">

                                <label for="consultation_fee">
                                    Consultation Fee <span class="req">*</span>
                                </label>

                                <input type="number" id="consultation_fee" name="consultation_fee" class="form-control"
                                    value="{{ old('consultation_fee') }}" placeholder="e.g. 500.00" step="0.01"
                                    min="0">

                                @error('consultation_fee')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                        </div>




                        <!-- ACTIONS -->
                        <div class="form-actions">

                            <a href="{{ route('doctors.index') }}" class="btn-cancel">
                                Cancel
                            </a>

                            <button type="submit" class="btn-submit">
                                <i class="fas fa-plus"></i>
                                Create Doctor
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </main>

@endsection
