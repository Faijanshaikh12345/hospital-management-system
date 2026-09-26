<!-- ========== HOSPITAL MANAGEMENT SIDEBAR ========== -->

<aside class="sidebar" id="sidebar">

    <!-- ========== BRAND ========== -->
    <div class="sidebar-brand">

        <div class="brand-icon">
            <i class="fas fa-hospital"></i>
        </div>

        <div class="brand-text">
            <span class="brand-name">HMS</span>
            <span class="brand-sub">Hospital Management</span>
        </div>

        <button class="sidebar-close" id="sidebarClose">
            <i class="fas fa-times"></i>
        </button>

    </div>


    <!-- ========== LOGGED IN USER ========== -->
    <div class="sidebar-user">

        <div class="user-avatar">

            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=6366f1&color=fff&size=80"
                alt="{{ auth()->user()->name }}">

            <span class="user-status online"></span>

        </div>

        <div class="user-info">

            <strong>{{ auth()->user()->name }}</strong>

            <span>{{ ucfirst(auth()->user()->role) }}</span>

        </div>

    </div>


    <!-- ========== NAVIGATION ========== -->
    <nav class="sidebar-nav">


        <!-- ===================================================== -->
        <!-- MAIN MENU -->
        <!-- ===================================================== -->

        <div class="nav-label">
            Main Menu
        </div>


        <!-- Dashboard - EVERYONE -->
        <a href="{{ url('/dashboard') }}" class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">

            <i class="fas fa-gauge-high"></i>

            <span>Dashboard</span>

        </a>


        <!-- ===================================================== -->
        <!-- HOSPITAL MANAGEMENT -->
        <!-- ===================================================== -->

        <div class="nav-label">
            Hospital Management
        </div>


        <!-- ==================== DOCTORS ==================== -->
        @if (in_array(auth()->user()->role, ['admin', 'doctor', 'receptionist']))
            <a href=" {{ route('doctors.index') }} " class="nav-item {{ request()->is('doctors*') ? 'active' : '' }}">

                <i class="fas fa-user-doctor"></i>

                <span>Doctors</span>

            </a>
        @endif



        <!-- ==================== PATIENTS ==================== -->
        @if (in_array(auth()->user()->role, ['admin', 'doctor', 'receptionist', 'nurse']))
            <a href="{{ route('patients.index') }}" class="nav-item {{ request()->is('patients*') ? 'active' : '' }}">

                <i class="fas fa-user-injured"></i>

                <span>Patients</span>

            </a>
        @endif



        <!-- ==================== DEPARTMENTS ==================== -->
        @if (in_array(auth()->user()->role, ['admin', 'doctor', 'receptionist']))
            <a href="{{ route('departments.index') }}"
                class="nav-item {{ request()->is('departments*') ? 'active' : '' }}">

                <i class="fas fa-building"></i>

                <span>Departments</span>

            </a>
        @endif



        <!-- ==================== APPOINTMENTS ==================== -->
        @if (in_array(auth()->user()->role, ['admin', 'doctor', 'receptionist', 'nurse', 'patient']))
            <a href="{{ route('appointments.index') }}"
                class="nav-item {{ request()->is('appointments*') ? 'active' : '' }}">

                <i class="fas fa-calendar-check"></i>

                <span>Appointments</span>

            </a>
        @endif



        <!-- ===================================================== -->
        <!-- PATIENT CARE -->
        <!-- ===================================================== -->

        <div class="nav-label">
            Patient Care
        </div>


        <!-- ==================== MEDICAL RECORDS ==================== -->
        @if (in_array(auth()->user()->role, ['admin', 'doctor', 'nurse', 'patient']))
            <a href=" {{ route('medicalRecord.index') }}"
                class="nav-item {{ request()->is('medicalRecord*') ? 'active' : '' }}">

                <i class="fas fa-file-medical"></i>

                <span>Medical Records</span>

            </a>
        @endif



        <!-- ==================== PRESCRIPTIONS ==================== -->
        @if (in_array(auth()->user()->role, ['admin', 'doctor', 'nurse', 'patient']))
            <a href="{{ route('prescriptions.index') }}"
                class="nav-item {{ request()->is('prescriptions*') ? 'active' : '' }}">

                <i class="fas fa-prescription-bottle-medical"></i>

                <span>Prescriptions</span>

            </a>
        @endif



        <!-- ==================== MEDICINES ==================== -->
        @if (in_array(auth()->user()->role, ['admin', 'doctor', 'nurse']))
            <a href="{{ route('medicines.index') }}"
                class="nav-item {{ request()->is('medicines*') ? 'active' : '' }}">

                <i class="fas fa-pills"></i>

                <span>Medicines</span>

            </a>
        @endif

        <!-- ==================== ADMISSIONS ==================== -->
        @if (in_array(auth()->user()->role, ['admin', 'doctor', 'nurse']))
            <a href="{{ route('admissions.index') }}"
                class="nav-item {{ request()->is('admissions*') ? 'active' : '' }}">

                <i class="fas fa-bed"></i>

                <span>Admissions</span>

            </a>
        @endif






        <!-- ==================== BILLING ==================== -->
        @if (in_array(auth()->user()->role, ['admin', 'receptionist', 'patient']))
            <!-- ===================================================== -->
            <!-- FINANCE -->
            <!-- ===================================================== -->

            <div class="nav-label">
                Finance
            </div>

            <a href="{{ route('billings.index') }}" class="nav-item {{ request()->is('billings*') ? 'active' : '' }}">

                <i class="fas fa-file-invoice-dollar"></i>

                <span>Billing</span>

            </a>
        @endif



        <!-- ===================================================== -->
        <!-- REPORTS -->
        <!-- ===================================================== -->

        @if (in_array(auth()->user()->role, ['admin', 'receptionist']))
            <div class="nav-label">
                Reports
            </div>


            <a href="{{ route('reports.index') }}" class="nav-item {{ request()->is('reports*') ? 'active' : '' }}">

                <i class="fas fa-chart-line"></i>

                <span>Reports</span>

            </a>
        @endif



        <!-- ===================================================== -->
        <!-- ADMINISTRATION -->
        <!-- ===================================================== -->

        @if (auth()->user()->role === 'admin')
            <div class="nav-label">
                Administration
            </div>

            <!-- Users -->
            <a href="{{ route('users.index') }}" class="nav-item {{ request()->routeIs('users.*') ? 'active' : '' }}">

                <i class="fas fa-users-gear"></i>

                <span>Users</span>

            </a>

            <!-- Settings -->
            <!-- ==================== SETTINGS ==================== -->
            <a href="{{ route('settings.index') }}" class="nav-item {{ request()->is('settings*') ? 'active' : '' }}">

                <i class="fas fa-gear"></i>

                <span>Settings</span>

            </a>
        @endif



        <!-- ===================================================== -->
        <!-- PROFILE -->
        <!-- ===================================================== -->

        @if (auth()->user()->role !== 'admin')
            <div class="nav-label">
                Account
            </div>


            <a href="{{ route('settings.index') }}" class="nav-item {{ request()->is('settings*') ? 'active' : '' }}">
                <i class="fas fa-user-cog"></i>
                <span>Profile Settings</span>
            </a>
        @endif



        <!-- ===================================================== -->
        <!-- LOGOUT -->
        <!-- ===================================================== -->

        <form action="{{ route('logout') }}" method="POST">

            @csrf

            <button type="submit" class="nav-item text-danger-nav"
                style="width: 100%; border: none; background: none; text-align: left; cursor: pointer;">

                <i class="fas fa-right-from-bracket"></i>

                <span>Logout</span>

            </button>

        </form>


    </nav>

</aside>
