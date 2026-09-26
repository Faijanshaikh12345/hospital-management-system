@extends('layouts.admin')

@section('content')

<style>
    .access-denied-wrapper {
        min-height: 65vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .access-denied-card {
        width: 100%;
        max-width: 600px;
        background: #ffffff;
        border-radius: 15px;
        padding: 45px 35px;
        text-align: center;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);
        border: 1px solid #e5e7eb;
    }

    .access-denied-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 20px;
        border-radius: 50%;
        background: #fee2e2;
        color: #dc2626;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 35px;
    }

    .access-denied-code {
        font-size: 52px;
        font-weight: 700;
        color: #dc2626;
        margin: 0;
        line-height: 1;
    }

    .access-denied-title {
        font-size: 25px;
        font-weight: 600;
        color: #1f2937;
        margin-top: 15px;
        margin-bottom: 10px;
    }

    .access-denied-message {
        color: #6b7280;
        font-size: 15px;
        line-height: 1.6;
        margin-bottom: 25px;
    }

    .dashboard-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 11px 22px;
        border-radius: 8px;
        background: #6366f1;
        color: #ffffff;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        transition: 0.2s;
    }

    .dashboard-btn:hover {
        background: #4f46e5;
        color: #ffffff;
        text-decoration: none;
    }
</style>


<div class="access-denied-wrapper">

    <div class="access-denied-card">

        <div class="access-denied-icon">
            <i class="fas fa-lock"></i>
        </div>

        <h1 class="access-denied-code">403</h1>

        <h2 class="access-denied-title">
            Access Denied
        </h2>

        <p class="access-denied-message">
            Sorry, you don't have permission to access this page.
            Please contact your administrator if you believe you should
            have access to this resource.
        </p>

        <a href="{{ route('dashboard') }}" class="dashboard-btn">
            <i class="fas fa-home"></i>
            Back to Dashboard
        </a>

    </div>

</div>

@endsection
