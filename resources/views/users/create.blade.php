@extends('layouts.admin')

@section('title', 'Add User')

@section('content')

<style>
    .user-form-wrap {
        max-width: 700px;
        margin: 0 auto;
    }

    .user-form-card {
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.06);
        border: 1px solid #eef0f4;
        overflow: hidden;
    }

    .user-form-header {
        padding: 22px 24px;
        border-bottom: 1px solid #eef0f4;
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    }

    .user-form-header h2 {
        color: #fff;
        font-size: 19px;
        font-weight: 700;
        margin: 0;
    }

    .user-form-header p {
        color: rgba(255, 255, 255, 0.85);
        font-size: 13px;
        margin: 4px 0 0;
    }

    .user-form-body {
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
    .field select {
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

    .field .form-control:focus,
    .field select:focus {
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
        <h1>Add User</h1>
        <p>Create a new hospital staff or patient account.</p>
    </div>

</div>


<!-- ========== FORM ========== -->
<div class="user-form-wrap">

    <div class="user-form-card">


        <!-- ========== HEADER ========== -->
        <div class="user-form-header">

            <h2>New User Account</h2>

            <p>Fill in the details below to create a new account.</p>

        </div>


        <!-- ========== BODY ========== -->
        <div class="user-form-body">

            <form action="{{ route('users.store') }}" method="POST">

                @csrf


                <div class="field">

                        <label for="name">
                            Full Name <span class="req">*</span>
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="form-control"
                            value="{{ old('name') }}"
                            placeholder="e.g. Dr. Rahul Sharma"
                        >

                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>


                <!-- FULL NAME + EMAIL -->
                <div class="form-row">
                    <div class="field">

                        <label for="email">
                            Email <span class="req">*</span>
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email') }}"
                            placeholder="e.g. rahul@example.com"
                        >

                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>

                    <div class="field">

                        <label for="phone">
                            Phone Number <span class="req">*</span>
                        </label>

                        <input
                            type="text"
                            id="phone"
                            name="phone"
                            class="form-control"
                            value="{{ old('phone') }}"
                            placeholder="e.g. 9876543210"
                        >

                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>

                </div>


                <!-- PHONE + ROLE -->
                <div class="form-row">

                    <div class="field">

                        <label for="role">
                            Role <span class="req">*</span>
                        </label>

                        <select id="role" name="role">

                            <option value="">Select Role</option>

                            <option value="admin"
                                {{ old('role') == 'admin' ? 'selected' : '' }}>
                                Admin
                            </option>

                            <option value="doctor"
                                {{ old('role') == 'doctor' ? 'selected' : '' }}>
                                Doctor
                            </option>

                            <option value="receptionist"
                                {{ old('role') == 'receptionist' ? 'selected' : '' }}>
                                Receptionist
                            </option>

                            <option value="nurse"
                                {{ old('role') == 'nurse' ? 'selected' : '' }}>
                                Nurse
                            </option>

                            <option value="patient"
                                {{ old('role') == 'patient' ? 'selected' : '' }}>
                                Patient
                            </option>

                        </select>

                        @error('role')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>

                    <div class="field">

                        <label for="status">
                            Status <span class="req">*</span>
                        </label>

                        <select id="status" name="status">

                            <option value="active"
                                {{ old('status', 'active') == 'active' ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="inactive"
                                {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                Inactive
                            </option>

                        </select>

                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>

                </div>


                <!-- STATUS + PASSWORD -->
                <div class="form-row">


                    <div class="field">

                        <label for="password">
                            Password <span class="req">*</span>
                        </label>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control"
                            placeholder="Minimum 6 characters"
                        >

                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>

                    <div class="field">

                    <label for="password_confirmation">
                        Confirm Password <span class="req">*</span>
                    </label>

                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="form-control"
                        placeholder="Re-enter password"
                    >

                </div>

                </div>


                <!-- CONFIRM PASSWORD -->



                <!-- ACTIONS -->
                <div class="form-actions">

                    <a
                        href="{{ route('users.index') }}"
                        class="btn-cancel"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="btn-submit"
                    >
                        <i class="fas fa-plus"></i>
                        Create User
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

</main>

@endsection
