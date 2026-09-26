@extends('layouts.admin')

@section('title', 'Agents')

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
    }

    .btn-new-user:hover { opacity: 0.92; color: #fff; }

    .alert-box {
        padding: 12px 16px;
        border-radius: 8px;
        font-size: 14px;
        margin-bottom: 18px;
    }

    .alert-success { background: #ecfdf5; border: 1px solid #a7f3d0; color: #047857; }
    .alert-error { background: #fef2f2; border: 1px solid #fecaca; color: #dc2626; }

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

    .users-card-header h3 { font-size: 16px; font-weight: 700; color: #1f2937; margin: 0; }

    .users-count-badge {
        background: #eef2ff;
        color: #4f46e5;
        font-size: 12.5px;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 20px;
    }

    .users-table-wrap { overflow-x: auto; }
    .users-table { width: 100%; border-collapse: collapse; }

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
    }

    .users-table tbody tr:last-child { border-bottom: none; }
    .users-table tbody tr:hover { background: #fafaff; }

    .user-cell { display: flex; align-items: center; gap: 10px; }
    .user-cell img { width: 34px; height: 34px; border-radius: 50%; }
    .user-cell strong { display: block; color: #1f2937; font-size: 13.5px; }

    .assigned-badge {
        background: #eef2ff;
        color: #4f46e5;
        font-size: 12px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 20px;
    }

    .action-icons a, .action-icons button {
        margin-right: 12px;
        border: none;
        background: none;
        cursor: pointer;
        padding: 0;
    }

    .users-empty {
        text-align: center;
        padding: 56px 20px;
        color: #9ca3af;
        font-size: 14.5px;
    }
</style>

<main class="content">

    <div class="users-page-title">
        <div>
            <h1>Agents</h1>
            <p>All support agents in the system</p>
        </div>

        <a href="{{ route('users.create') }}" class="btn-new-user">
            <i class="fas fa-plus"></i> Add Agent
        </a>
    </div>

    @if(session('success'))
        <div class="alert-box alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert-box alert-error">{{ session('error') }}</div>
    @endif

    <div class="users-card">

        <div class="users-card-header">
            <h3>Agents</h3>
            <span class="users-count-badge">{{ $users->count() }} total</span>
        </div>

        @if($users->count() > 0)

            <div class="users-table-wrap">
                <table class="users-table">

                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Assigned Tickets</th>
                            <th>Joined</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    <div class="user-cell">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=d97706&color=fff&size=60" alt="">
                                        <strong>{{ $user->name }}</strong>
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="assigned-badge">{{ $user->assignedTickets()->count() }}</span>
                                </td>
                                <td>{{ $user->created_at ? $user->created_at->format('d M Y') : '—' }}</td>
                                <td class="action-icons">
                                    <a href="{{ route('users.edit', $user->id) }}" title="Edit">
                                        <i class="fas fa-pen" style="color:#6366f1;"></i>
                                    </a>

                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this agent?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Delete">
                                            <i class="fas fa-trash" style="color:#dc2626;"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        @else

            <div class="users-empty">
                No agents yet. <a href="{{ route('users.create') }}">Add one</a>.
            </div>

        @endif

    </div>

</main>

@endsection
