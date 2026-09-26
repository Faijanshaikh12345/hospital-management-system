@extends('layouts.admin')

@section('title', 'All Users')

@section('content')

<style>
    .users-page-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 22px;
        flex-wrap: wrap;
        gap: 12px;
    }

    .users-page-title h1 {
        font-size: 22px;
        font-weight: 700;
        color: #1f2937;
        margin: 0;
    }

    .users-page-title p {
        color: #6b7280;
        font-size: 13.5px;
        margin: 4px 0 0;
    }

    .btn-new-user {
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

    .btn-new-user:hover {
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

    .users-card {
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.06);
        border: 1px solid #eef0f4;
        overflow: hidden;
    }

    .users-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 18px 24px;
        border-bottom: 1px solid #eef0f4;
    }

    .users-card-header h3 {
        font-size: 16px;
        font-weight: 700;
        color: #1f2937;
        margin: 0;
    }

    .users-count-badge {
        background: #eef2ff;
        color: #4f46e5;
        font-size: 12.5px;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 20px;
    }

    .users-table-wrap {
        overflow-x: auto;
    }

    .users-table {
        width: 100%;
        border-collapse: collapse;
    }

    .users-table thead th {
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

    .users-table tbody td {
        padding: 14px 20px;
        font-size: 14px;
        color: #374151;
        border-bottom: 1px solid #f1f2f6;
        vertical-align: middle;
        white-space: nowrap;
    }

    .users-table tbody tr:last-child td {
        border-bottom: none;
    }

    .users-table tbody tr:hover {
        background: #fafaff;
    }

    .user-cell {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .user-cell img {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        object-fit: cover;
    }

    .user-cell strong {
        display: block;
        color: #1f2937;
        font-size: 13.5px;
    }

    .role-badge {
        display: inline-flex;
        align-items: center;
        font-size: 12px;
        font-weight: 700;
        padding: 5px 11px;
        border-radius: 20px;
        text-transform: capitalize;
    }

    /* Role Colors */
    .role-badge.admin {
        background: #eef2ff;
        color: #4f46e5;
    }

    .role-badge.doctor {
        background: #ecfeff;
        color: #0891b2;
    }

    .role-badge.receptionist {
        background: #fff7ed;
        color: #ea580c;
    }

    .role-badge.nurse {
        background: #fdf2f8;
        color: #db2777;
    }

    .role-badge.patient {
        background: #f0fdf4;
        color: #16a34a;
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

    .status-badge.active {
        background: #ecfdf5;
        color: #059669;
    }

    .status-badge.inactive {
        background: #fef2f2;
        color: #dc2626;
    }

    .status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
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
        .users-page-title {
            align-items: flex-start;
        }

        .btn-new-user {
            width: 100%;
            justify-content: center;
        }

        .users-card-header {
            padding: 16px;
        }

        .users-table thead th,
        .users-table tbody td {
            padding: 12px 14px;
        }
    }
</style>

<main class="content">

    <!-- Page Header -->
    <div class="users-page-title">
        <div>
            <h1>All Users</h1>
            <p>Manage hospital staff and patient accounts</p>
        </div>

        <a href="{{ route('users.create') }}" class="btn-new-user">
            <i class="fas fa-plus"></i>
            Add User
        </a>
    </div>


    <!-- Success Message -->
    @if(session('success'))
        <div class="alert-box alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif


    <!-- Error Message -->
    @if(session('error'))
        <div class="alert-box alert-error">
            <i class="fas fa-exclamation-circle"></i>
            {{ session('error') }}
        </div>
    @endif


    <!-- Validation Errors -->
    @if($errors->any())
        <div class="alert-box alert-error">
            <strong>Please fix the following errors:</strong>

            <ul style="margin: 8px 0 0 18px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <!-- Users Card -->
    <div class="users-card">

        <!-- Card Header -->
        <div class="users-card-header">
            <h3>
                <i class="fas fa-users" style="margin-right: 7px; color:#6366f1;"></i>
                Hospital Users
            </h3>

            <span class="users-count-badge">
                {{ $users->count() }} total
            </span>
        </div>


        <!-- Table -->
        <div class="users-table-wrap">

            <table class="users-table">

                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Joined</th>
                        <th>Actions</th>
                    </tr>
                </thead>


                <tbody>

                    @forelse($users as $user)

                        <tr>

                            <!-- Name -->
                            <td>
                                <div class="user-cell">

                                    <img
                                        src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=6366f1&color=fff&size=60"
                                        alt="{{ $user->name }}"
                                    >

                                    <strong>
                                        {{ $user->name }}
                                    </strong>

                                </div>
                            </td>


                            <!-- Email -->
                            <td>
                                {{ $user->email }}
                            </td>


                            <!-- Phone -->
                            <td>
                                {{ $user->phone ?? '—' }}
                            </td>


                            <!-- Role -->
                            <td>

                                <span class="role-badge {{ strtolower($user->role) }}">

                                    @if($user->role === 'admin')
                                        <i class="fas fa-user-shield" style="margin-right:5px;"></i>
                                    @elseif($user->role === 'doctor')
                                        <i class="fas fa-user-md" style="margin-right:5px;"></i>
                                    @elseif($user->role === 'receptionist')
                                        <i class="fas fa-concierge-bell" style="margin-right:5px;"></i>
                                    @elseif($user->role === 'nurse')
                                        <i class="fas fa-user-nurse" style="margin-right:5px;"></i>
                                    @elseif($user->role === 'patient')
                                        <i class="fas fa-user" style="margin-right:5px;"></i>
                                    @endif

                                    {{ $user->role }}

                                </span>

                            </td>


                            <!-- Status -->
                            <td>

                                <span class="status-badge {{ strtolower($user->status) }}">

                                    <span class="status-dot"></span>

                                    {{ $user->status }}

                                </span>

                            </td>


                            <!-- Joined -->
                            <td>
                                {{ $user->created_at ? $user->created_at->format('d M Y') : '—' }}
                            </td>


                            <!-- Actions -->
                            <td class="action-icons">

                                <!-- Edit -->
                                <a
                                    href="{{ route('users.edit', $user->id) }}"
                                    title="Edit User"
                                >
                                    <i
                                        class="fas fa-pen"
                                        style="color:#6366f1;"
                                    ></i>
                                </a>


                                <!-- Delete -->
                                @if($user->id !== auth()->id())

                                    <form
                                        action="{{ route('users.destroy', $user->id) }}"
                                        method="POST"
                                        style="display:inline;"
                                        onsubmit="return confirm('Are you sure you want to delete this user?');"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            title="Delete User"
                                        >
                                            <i
                                                class="fas fa-trash"
                                                style="color:#dc2626;"
                                            ></i>
                                        </button>

                                    </form>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7">

                                <div class="empty-state">

                                    <i class="fas fa-users"></i>

                                    <h4>No Users Found</h4>

                                    <p>
                                        No hospital users have been added yet.
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
