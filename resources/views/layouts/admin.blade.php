<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Helpdesk')</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body>

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    {{-- Sidebar Overlay --}}
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    {{-- Main Wrapper --}}
    <div class="main-wrapper" id="mainWrapper">

        {{-- Header --}}
        @include('layouts.header')

        {{-- Page Content --}}
        <main class="content">

            @yield('content')

        </main>

        {{-- Footer --}}
        @include('layouts.footer')

    </div>

    <!-- Custom JS -->
    <script src="{{ asset('js/main.js') }}"></script>

</body>

</html>
