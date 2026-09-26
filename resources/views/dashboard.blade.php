@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<style>
    .stat-link {
        text-decoration: none;
        color: inherit;
        display: block;
    }

    .stat-link:hover .stat-card {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    }

    .stat-card {
        transition: 0.2s;
    }
</style>

<main class="content">

    <!-- Page Title -->
    <div class="page-title">
      <div>
        <h1>Dashboard Overview</h1>
        <p>Welcome back, {{ auth()->user()->name }}! Here's what's happening today.</p>
      </div>
    </div>

    <div class="stats-grid">

        <!-- ======= ADMIN CARDS ======= -->
        @if(auth()->user()->role === 'admin')

            <a href="{{ route('users.index') }}" class="stat-link">
                <div class="stat-card">
                    <div class="stat-icon bg-indigo"><i class="fas fa-users"></i></div>
                    <div class="stat-body">
                        <span class="stat-label">Total Users</span>
                        <h3 class="stat-value">{{ $totalUsers ?? 0 }}</h3>
                    </div>
                </div>
            </a>

            <a href="{{ route('doctors.index') }}" class="stat-link">
                <div class="stat-card">
                    <div class="stat-icon bg-emerald"><i class="fas fa-user-doctor"></i></div>
                    <div class="stat-body">
                        <span class="stat-label">Total Doctors</span>
                        <h3 class="stat-value">{{ $totalDoctors ?? 0 }}</h3>
                    </div>
                </div>
            </a>

            <a href="{{ route('patients.index') }}" class="stat-link">
                <div class="stat-card">
                    <div class="stat-icon bg-amber"><i class="fas fa-user-injured"></i></div>
                    <div class="stat-body">
                        <span class="stat-label">Total Patients</span>
                        <h3 class="stat-value">{{ $totalPatients ?? 0 }}</h3>
                    </div>
                </div>
            </a>

            <a href="{{ route('departments.index') }}" class="stat-link">
                <div class="stat-card">
                    <div class="stat-icon bg-amber"><i class="fas fa-building"></i></div>
                    <div class="stat-body">
                        <span class="stat-label">Total Departments</span>
                        <h3 class="stat-value">{{ $totalDepartments ?? 0 }}</h3>
                    </div>
                </div>
            </a>

            <a href="{{ route('appointments.index') }}" class="stat-link">
                <div class="stat-card">
                    <div class="stat-icon bg-indigo"><i class="fas fa-calendar-check"></i></div>
                    <div class="stat-body">
                        <span class="stat-label">Total Appointments</span>
                        <h3 class="stat-value">{{ $totalAppointments ?? 0 }}</h3>
                    </div>
                </div>
            </a>

            <a href="{{ route('billings.index') }}" class="stat-link">
                <div class="stat-card">
                    <div class="stat-icon bg-emerald"><i class="fas fa-indian-rupee-sign"></i></div>
                    <div class="stat-body">
                        <span class="stat-label">Total Revenue</span>
                        <h3 class="stat-value">₹{{ number_format($totalRevenue ?? 0, 2) }}</h3>
                    </div>
                </div>
            </a>

            <a href="{{ route('admissions.index') }}" class="stat-link">
                <div class="stat-card">
                    <div class="stat-icon bg-indigo"><i class="fas fa-bed"></i></div>
                    <div class="stat-body">
                        <span class="stat-label">Currently Admitted</span>
                        <h3 class="stat-value">{{ $activeAdmissions ?? 0 }}</h3>
                    </div>
                </div>
            </a>

            <a href="{{ route('medicines.index') }}" class="stat-link">
                <div class="stat-card">
                    <div class="stat-icon bg-amber"><i class="fas fa-exclamation-triangle"></i></div>
                    <div class="stat-body">
                        <span class="stat-label">Low Stock Medicines</span>
                        <h3 class="stat-value">{{ $lowStockMedicines ?? 0 }}</h3>
                    </div>
                </div>
            </a>

        @endif


        <!-- ======= DOCTOR CARDS ======= -->
        @if(auth()->user()->role === 'doctor')

            <a href="{{ route('patients.index') }}" class="stat-link">
                <div class="stat-card">
                    <div class="stat-icon bg-amber"><i class="fas fa-user-injured"></i></div>
                    <div class="stat-body">
                        <span class="stat-label">Total Patients</span>
                        <h3 class="stat-value">{{ $totalPatients ?? 0 }}</h3>
                    </div>
                </div>
            </a>

            <a href="{{ route('doctors.index') }}" class="stat-link">
                <div class="stat-card">
                    <div class="stat-icon bg-emerald"><i class="fas fa-user-doctor"></i></div>
                    <div class="stat-body">
                        <span class="stat-label">Total Doctors</span>
                        <h3 class="stat-value">{{ $totalDoctors ?? 0 }}</h3>
                    </div>
                </div>
            </a>

            <a href="{{ route('departments.index') }}" class="stat-link">
                <div class="stat-card">
                    <div class="stat-icon bg-amber"><i class="fas fa-building"></i></div>
                    <div class="stat-body">
                        <span class="stat-label">Total Departments</span>
                        <h3 class="stat-value">{{ $totalDepartments ?? 0 }}</h3>
                    </div>
                </div>
            </a>

            <a href="{{ route('appointments.index') }}" class="stat-link">
                <div class="stat-card">
                    <div class="stat-icon bg-indigo"><i class="fas fa-calendar-check"></i></div>
                    <div class="stat-body">
                        <span class="stat-label">My Appointments</span>
                        <h3 class="stat-value">{{ $myAppointments ?? 0 }}</h3>
                    </div>
                </div>
            </a>

            <a href="{{ route('admissions.index') }}" class="stat-link">
                <div class="stat-card">
                    <div class="stat-icon bg-indigo"><i class="fas fa-bed"></i></div>
                    <div class="stat-body">
                        <span class="stat-label">My Active Admissions</span>
                        <h3 class="stat-value">{{ $myAdmissions ?? 0 }}</h3>
                    </div>
                </div>
            </a>

        @endif


        <!-- ======= RECEPTIONIST CARDS ======= -->
        @if(auth()->user()->role === 'receptionist')

            <a href="{{ route('patients.index') }}" class="stat-link">
                <div class="stat-card">
                    <div class="stat-icon bg-amber"><i class="fas fa-user-injured"></i></div>
                    <div class="stat-body">
                        <span class="stat-label">Total Patients</span>
                        <h3 class="stat-value">{{ $totalPatients ?? 0 }}</h3>
                    </div>
                </div>
            </a>

            <a href="{{ route('doctors.index') }}" class="stat-link">
                <div class="stat-card">
                    <div class="stat-icon bg-emerald"><i class="fas fa-user-doctor"></i></div>
                    <div class="stat-body">
                        <span class="stat-label">Total Doctors</span>
                        <h3 class="stat-value">{{ $totalDoctors ?? 0 }}</h3>
                    </div>
                </div>
            </a>

            <a href="{{ route('appointments.index') }}" class="stat-link">
                <div class="stat-card">
                    <div class="stat-icon bg-indigo"><i class="fas fa-calendar-check"></i></div>
                    <div class="stat-body">
                        <span class="stat-label">Total Appointments</span>
                        <h3 class="stat-value">{{ $totalAppointments ?? 0 }}</h3>
                    </div>
                </div>
            </a>

            <a href="{{ route('billings.index') }}" class="stat-link">
                <div class="stat-card">
                    <div class="stat-icon bg-emerald"><i class="fas fa-indian-rupee-sign"></i></div>
                    <div class="stat-body">
                        <span class="stat-label">Total Revenue</span>
                        <h3 class="stat-value">₹{{ number_format($totalRevenue ?? 0, 2) }}</h3>
                    </div>
                </div>
            </a>

            <a href="{{ route('billings.index') }}" class="stat-link">
                <div class="stat-card">
                    <div class="stat-icon bg-amber"><i class="fas fa-hourglass-half"></i></div>
                    <div class="stat-body">
                        <span class="stat-label">Pending Invoices</span>
                        <h3 class="stat-value">{{ $pendingBillings ?? 0 }}</h3>
                    </div>
                </div>
            </a>

        @endif


        <!-- ======= NURSE CARDS ======= -->
        @if(auth()->user()->role === 'nurse')

            <a href="{{ route('patients.index') }}" class="stat-link">
                <div class="stat-card">
                    <div class="stat-icon bg-amber"><i class="fas fa-user-injured"></i></div>
                    <div class="stat-body">
                        <span class="stat-label">Total Patients</span>
                        <h3 class="stat-value">{{ $totalPatients ?? 0 }}</h3>
                    </div>
                </div>
            </a>

            <a href="{{ route('admissions.index') }}" class="stat-link">
                <div class="stat-card">
                    <div class="stat-icon bg-indigo"><i class="fas fa-bed"></i></div>
                    <div class="stat-body">
                        <span class="stat-label">Currently Admitted</span>
                        <h3 class="stat-value">{{ $activeAdmissions ?? 0 }}</h3>
                    </div>
                </div>
            </a>

            <a href="{{ route('medicines.index') }}" class="stat-link">
                <div class="stat-card">
                    <div class="stat-icon bg-amber"><i class="fas fa-exclamation-triangle"></i></div>
                    <div class="stat-body">
                        <span class="stat-label">Low Stock Medicines</span>
                        <h3 class="stat-value">{{ $lowStockMedicines ?? 0 }}</h3>
                    </div>
                </div>
            </a>

        @endif


        <!-- ======= PATIENT CARDS ======= -->
        @if(auth()->user()->role === 'patient')

            <a href="{{ route('appointments.index') }}" class="stat-link">
                <div class="stat-card">
                    <div class="stat-icon bg-indigo"><i class="fas fa-calendar-check"></i></div>
                    <div class="stat-body">
                        <span class="stat-label">My Appointments</span>
                        <h3 class="stat-value">{{ $myAppointments ?? 0 }}</h3>
                    </div>
                </div>
            </a>

            <a href="{{ route('medicalRecord.index') }}" class="stat-link">
                <div class="stat-card">
                    <div class="stat-icon bg-emerald"><i class="fas fa-file-medical"></i></div>
                    <div class="stat-body">
                        <span class="stat-label">My Medical Records</span>
                        <h3 class="stat-value">{{ $myMedicalRecords ?? 0 }}</h3>
                    </div>
                </div>
            </a>

            <a href="{{ route('prescriptions.index') }}" class="stat-link">
                <div class="stat-card">
                    <div class="stat-icon bg-amber"><i class="fas fa-prescription-bottle-medical"></i></div>
                    <div class="stat-body">
                        <span class="stat-label">My Prescriptions</span>
                        <h3 class="stat-value">{{ $myPrescriptions ?? 0 }}</h3>
                    </div>
                </div>
            </a>

            <a href="{{ route('billings.index') }}" class="stat-link">
                <div class="stat-card">
                    <div class="stat-icon bg-amber"><i class="fas fa-indian-rupee-sign"></i></div>
                    <div class="stat-body">
                        <span class="stat-label">Amount Due</span>
                        <h3 class="stat-value">₹{{ number_format($myBillingsDue ?? 0, 2) }}</h3>
                    </div>
                </div>
            </a>

        @endif

    </div>

</main>

@endsection
