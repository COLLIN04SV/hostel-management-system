<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Hostel Management System')</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-slate-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->

    <aside class="fixed top-0 left-0 h-screen w-64 bg-blue-900 text-white flex flex-col shadow-xl z-40 overflow-hidden">

        <!-- Logo -->

        <div class="p-6 border-b border-blue-800">

            <h1 class="text-3xl font-bold">
                HMS
            </h1>

            <p class="text-blue-200 text-sm">
                Hostel Management System
            </p>

        </div>

        <!-- Navigation -->

        <nav class="mt-4 flex-1 overflow-y-auto px-2">

            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-6 py-3 border-l-4 transition duration-200
                {{ request()->routeIs('admin.dashboard')
                ? 'bg-blue-700 border-white'
                : 'border-transparent hover:bg-slate-800 hover:border-blue-400' }}"
                <i class="bi bi-speedometer2"></i>
                Dashboard
            </a>

            <a href="{{ route('students.index') }}"
               class="flex items-center gap-3 px-6 py-3 border-l-4 transition duration-200
               {{ request()->routeIs('students.*')
               ? 'bg-blue-700 border-white'
               : 'border-transparent hover:bg-slate-800 hover:border-blue-400' }}"
                <i class="bi bi-people"></i>
                Students
            </a>

            <a href="{{ route('hostels.index') }}"
               class="flex items-center gap-3 px-6 py-3 border-l-4 transition duration-200
               {{ request()->routeIs('hostels.*')
               ? 'bg-blue-700 border-white'
               : 'border-transparent hover:bg-slate-800 hover:border-blue-400' }}"
                <i class="bi bi-building"></i>
                Hostels
            </a>

            <a href="{{ route('rooms.index') }}"
               class="flex items-center gap-3 px-6 py-3 border-l-4 transition duration-200
               {{ request()->routeIs('rooms.*')
               ? 'bg-blue-700 border-white'
               : 'border-transparent hover:bg-slate-800 hover:border-blue-400' }}"
                <i class="bi bi-door-open"></i>
                Rooms
            </a>

            <a href="{{ route('applications.index') }}"
               class="flex items-center gap-3 px-6 py-3 border-l-4 transition duration-200
               {{ request()->routeIs('applications.*')
               ? 'bg-blue-700 border-white'
               : 'border-transparent hover:bg-slate-800 hover:border-blue-400' }}"
                <i class="bi bi-file-earmark-text"></i>
                Applications
            </a>

            <a href="{{ route('allocations.index') }}"
               class="flex items-center gap-3 px-6 py-3 border-l-4 transition duration-200
               {{ request()->routeIs('allocations.*')
               ? 'bg-blue-700 border-white'
               : 'border-transparent hover:bg-slate-800 hover:border-blue-400' }}"
                <i class="bi bi-house-check"></i>
                Allocations
            </a>

            <a href="{{ route('payments.index') }}"
               class="flex items-center gap-3 px-6 py-3 border-l-4 transition duration-200
               {{ request()->routeIs('payments.*')
               ? 'bg-blue-700 border-white'
               : 'border-transparent hover:bg-slate-800 hover:border-blue-400' }}"
                <i class="bi bi-credit-card"></i>
                Payments
            </a>

            <a href="{{ route('notices.index') }}"
               class="flex items-center gap-3 px-6 py-3 border-l-4 transition duration-200
               {{ request()->routeIs('notices.*')
               ? 'bg-blue-700 border-white'
               : 'border-transparent hover:bg-slate-800 hover:border-blue-400' }}"
                <i class="bi bi-megaphone"></i>
                Notices
            </a>

            <a href="{{ route('reports.index') }}"
               class="flex items-center gap-3 px-6 py-3 border-l-4 transition duration-200
               {{ request()->routeIs('reports.*')
               ? 'bg-blue-700 border-white'
               : 'border-transparent hover:bg-slate-800 hover:border-blue-400' }}"
                <i class="bi bi-bar-chart"></i>
                Reports
            </a>

            <a href="{{ route('settings.index') }}"
               class="flex items-center gap-3 px-6 py-3 border-l-4 transition duration-200
               {{ request()->routeIs('settings.*')
               ? 'bg-blue-700 border-white'
               : 'border-transparent hover:bg-slate-800 hover:border-blue-400' }}"
                <i class="bi bi-gear"></i>
                Settings
            </a>

        </nav>

        <!-- Logged In User -->

        <div class="p-4 border-t border-blue-800">

            <div class="bg-blue-800 rounded-xl px-4 py-3">

    <div class="flex items-center gap-3">

        <div class="w-10 h-10 rounded-full bg-white text-blue-900 flex items-center justify-center font-bold">

            {{ strtoupper(substr(auth()->user()->name,0,1)) }}

        </div>

        <div>

            <p class="font-semibold text-sm">

                {{ auth()->user()->name }}

            </p>

            <p class="text-xs text-blue-200">

                {{ ucfirst(auth()->user()->role) }}

            </p>

        </div>

    </div>

</div>

            <!-- Logout -->

            <form method="POST" action="{{ route('logout') }}" class="mt-4">

                @csrf

                <button
                    type="submit"
                    class="w-full flex items-center justify-center gap-2 bg-red-600 hover:bg-red-700 py-3 rounded-xl transition">

                    <i class="bi bi-box-arrow-right"></i>

                    Logout

                </button>

            </form>

        </div>

    </aside>

    <!-- Main Content -->

    <main class="ml-64 flex-1">

        <!-- Top Bar -->

        <div class="fixed top-0 left-64 right-0 bg-white shadow-sm px-8 py-5 flex items-center justify-between z-30">

            <div>

                <h2 class="text-3xl font-bold text-gray-800">

                    @yield('page-title','Dashboard')

                </h2>

                <p class="text-gray-500">

                    @yield('page-description','Hostel Management System')

                </p>

            </div>

            <div class="flex items-center gap-5">

                <button
                class="relative w-10 h-10 rounded-full hover:bg-gray-100 transition flex items-center justify-center">

                    <i class="bi bi-bell text-2xl text-gray-600"></i>

                    <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs px-2 rounded-full">

                        3

                    </span>

                </button>

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold">

                        {{ strtoupper(substr(auth()->user()->name,0,1)) }}

                    </div>

                    <div>

                        <p class="font-semibold">

                            {{ auth()->user()->name }}

                        </p>

                        <p class="text-sm text-gray-500">

                            {{ ucfirst(auth()->user()->role) }}

                        </p>

                    </div>

                </div>

            </div>

        </div>

        <!-- Page -->

        <div class="pt-28 p-6 overflow-y-auto min-h-screen">

            @if(session('success'))

                <div class="mb-6 rounded-xl border border-green-200 bg-green-100 text-green-800 px-5 py-4">

                    <i class="bi bi-check-circle-fill mr-2"></i>

                    {{ session('success') }}

                </div>

            @endif

            @if(session('error'))

                <div class="mb-6 rounded-xl border border-red-200 bg-red-100 text-red-800 px-5 py-4">

                    <i class="bi bi-exclamation-circle-fill mr-2"></i>

                    {{ session('error') }}

                </div>

            @endif

            @yield('content')

        </div>

    </main>

</div>

</body>
</html>