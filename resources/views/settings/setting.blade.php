@extends('layouts.admin')

@section('title', 'Settings')

@section('content')

    <style>
        .settings-page-title {
            margin-bottom: 22px;
        }

        .settings-page-title h1 {
            font-size: 22px;
            font-weight: 700;
            color: #1f2937;
            margin: 0;
        }

        .settings-page-title p {
            color: #6b7280;
            font-size: 13.5px;
            margin: 4px 0 0;
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

        .settings-grid {
            display: grid;
            grid-template-columns: 320px 1fr;
            gap: 20px;
            align-items: start;
        }

        @media (max-width: 900px) {
            .settings-grid {
                grid-template-columns: 1fr;
            }
        }

        /* ===== Profile Summary Card ===== */
        .profile-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.06);
            border: 1px solid #eef0f4;
            overflow: hidden;
            text-align: center;
        }

        .profile-banner {
            height: 80px;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        }

        .settings-avatar {
            width: 88px;
            height: 88px;
            border-radius: 50%;
            background: #fff;
            border: 4px solid #fff;
            margin: -50px auto 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            font-weight: 700;
            color: #6366f1;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .setting-info {
            padding: 12px 24px 26px;
        }

        .setting-info h3 {
            margin: 4px 0 2px;
            font-size: 17px;
            font-weight: 700;
            color: #1f2937;
        }

        .setting-info p.email {
            margin: 0 0 12px;
            font-size: 13px;
            color: #6b7280;
        }

        .role-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
            font-weight: 600;
            padding: 5px 12px;
            border-radius: 20px;
            background: #eef2ff;
            color: #4f46e5;
            text-transform: capitalize;
        }

        .profile-meta {
            margin-top: 18px;
            padding-top: 18px;
            border-top: 1px solid #f1f2f6;
            text-align: left;
        }

        .profile-meta-row {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            padding: 6px 0;
        }

        .profile-meta-row span:first-child {
            color: #6b7280;
        }

        .profile-meta-row span:last-child {
            color: #1f2937;
            font-weight: 500;
        }

        /* ===== Form Cards ===== */
        .settings-forms {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .form-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.06);
            border: 1px solid #eef0f4;
            overflow: hidden;
        }

        .form-card-header {
            padding: 18px 24px;
            border-bottom: 1px solid #eef0f4;
        }

        .form-card-header h3 {
            font-size: 15.5px;
            font-weight: 700;
            color: #1f2937;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-card-header p {
            font-size: 12.5px;
            color: #9ca3af;
            margin: 4px 0 0;
        }

        .form-card-body {
            padding: 24px;
        }

        .field {
            margin-bottom: 18px;
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

        .field .form-control {
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

        .field .form-control:focus {
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
            flex: 1 1 200px;
            min-width: 180px;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 6px;
        }

        .btn-submit {
            padding: 11px 24px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-submit:hover {
            opacity: 0.92;
        }
    </style>

    <main class="content">

        <!-- Page Header -->
        <div class="settings-page-title">
            <h1>Settings</h1>
            <p>Manage your account profile and password</p>
        </div>


        <!-- Success Message -->
        @if (session('success'))
            <div class="alert-box alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif


        <!-- Error Message -->
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


        <div class="settings-grid">

            <!-- ======= LEFT: Profile Summary ======= -->
            <div class="profile-card">

                <div class="profile-banner"></div>

                <div class="settings-avatar">
                    {{ strtoupper(substr($user->name, 0, 1)) }}{{ strtoupper(substr(strrchr($user->name, ' ') ?: '', 1, 1)) }}
                </div>

                <div class="setting-info">
                    <h3>{{ $user->name }}</h3>
                    <p class="email">{{ $user->email }}</p>

                    <span class="role-badge">
                        <i class="fas fa-user-shield"></i>
                        {{ $user->role }}
                    </span>

                    <div class="profile-meta">

                        <div class="profile-meta-row">
                            <span>Phone</span>
                            <span>{{ $user->phone ?? '—' }}</span>
                        </div>

                        <div class="profile-meta-row">
                            <span>Status</span>
                            <span>{{ ucfirst($user->status ?? 'active') }}</span>
                        </div>

                        <div class="profile-meta-row">
                            <span>Joined</span>
                            <span>{{ $user->created_at ? $user->created_at->format('d M Y') : '—' }}</span>
                        </div>

                    </div>

                </div>

            </div>


            <!-- ======= RIGHT: Edit Forms ======= -->
            <div class="settings-forms">

                <!-- Profile Info Form -->
                <div class="form-card">

                    <div class="form-card-header">
                        <h3><i class="fas fa-user-pen" style="color:#6366f1;"></i> Profile Information</h3>
                        <p>Update your account's name, email, and phone number.</p>
                    </div>

                    <div class="form-card-body">

                        <form action="{{ route('settings.profile.update') }}" method="POST">

                            @csrf
                            @method('PUT')

                            <div class="form-row">

                                <div class="field">
                                    <label for="name">
                                        Full Name <span class="req">*</span>
                                    </label>

                                    <input type="text" id="name" name="name" class="form-control"
                                        value="{{ old('name', $user->name) }}">

                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="field">
                                    <label for="phone">
                                        Phone
                                    </label>

                                    <input type="text" id="phone" name="phone" class="form-control"
                                        value="{{ old('phone', $user->phone) }}">

                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>

                            <div class="field">
                                <label for="email">
                                    Email <span class="req">*</span>
                                </label>

                                <input type="email" id="email" name="email" class="form-control"
                                    value="{{ old('email', $user->email) }}">

                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn-submit">
                                    <i class="fas fa-save"></i>
                                    Save Profile
                                </button>
                            </div>

                        </form>

                    </div>

                </div>


                <!-- Password Form -->
                <div class="form-card">

                    <div class="form-card-header">
                        <h3><i class="fas fa-lock" style="color:#6366f1;"></i> Change Password</h3>
                        <p>Update your password to keep your account secure.</p>
                    </div>

                    <div class="form-card-body">

                        <form action="{{ route('settings.password.update') }}" method="POST">

                            @csrf
                            @method('PUT')

                            <div class="field">
                                <label for="current_password">
                                    Current Password <span class="req">*</span>
                                </label>

                                <input type="password" id="current_password" name="current_password" class="form-control">

                                @error('current_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-row">

                                <div class="field">
                                    <label for="password">
                                        New Password <span class="req">*</span>
                                    </label>

                                    <input type="password" id="password" name="password" class="form-control">

                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="field">
                                    <label for="password_confirmation">
                                        Confirm New Password <span class="req">*</span>
                                    </label>

                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="form-control">
                                </div>

                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn-submit">
                                    <i class="fas fa-key"></i>
                                    Update Password
                                </button>
                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </main>

@endsection
