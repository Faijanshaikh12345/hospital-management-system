<header class="header" id="header">

    <div class="header-left">

        <button class="toggle-btn" id="toggleBtn">
            <i class="fas fa-bars"></i>
        </button>

        <div class="breadcrumb-nav">

            <span class="breadcrumb-item">
                <i class="fas fa-house"></i>
            </span>

            <span class="breadcrumb-sep">/</span>

            <span class="breadcrumb-item active">
                Dashboard
            </span>

        </div>

    </div>


    <div class="header-right" style="margin-left: auto;">

        <button class="header-btn" title="Theme Toggle" id="themeToggle">
            <i class="fas fa-moon"></i>
        </button>


        {{-- Profile --}}
        <div class="header-btn header-btn--full profile-wrapper" id="profileToggle">

            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=6366f1&color=fff&size=40" alt="{{ auth()->user()->name }}"
                class="profile-avatar">

            <div class="profile-info">

                <span class="profile-name">
                    {{ auth()->user()->name }}
                </span>

                <span class="profile-role">
                    {{ ucfirst(auth()->user()->role) }}
                </span>

            </div>

            <i class="fas fa-chevron-down profile-arrow"></i>

            <div class="profile-dropdown" id="profileDropdown">

                <a href="{{ route('settings.index') }}">
                    <i class="fas fa-circle-user"></i>
                    My Profile
                </a>

                <div class="dropdown-divider"></div>

                <form action="{{ route('logout') }}" method="POST" style="text-align: center;">
                    @csrf

                    <button type="submit" class="text-danger"
                        style="border: none; background: none; cursor: pointer; padding: 0;color: red">

                        <i class="fas fa-right-from-bracket"></i>
                        Sign Out

                    </button>
                </form>

            </div>

        </div>

    </div>

</header>
