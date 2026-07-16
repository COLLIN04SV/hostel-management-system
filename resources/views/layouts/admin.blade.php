<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title','Hostel Management System')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-slate-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->

    <aside class="fixed top-0 left-0 h-screen w-64 bg-slate-900 text-white flex flex-col shadow-xl z-40">

        <!-- Logo -->

        <div class="px-6 py-6">

            <h1 class="text-3xl font-bold">

                <span class="text-indigo-500">OLIVER</span>

            </h1>

            <p class="text-slate-300 text-sm">

                Hostel Management System

            </p>

        </div>

        <!-- Navigation -->

        <nav class="flex-1 px-2 space-y-1 overflow-y-auto">

            <a href="{{ route('admin.dashboard') }}"
               class="block px-6 py-3 rounded-lg transition duration-200 hover:bg-slate-800
               {{ request()->routeIs('admin.dashboard')
                    ? 'bg-slate-800 text-white font-semibold'
                    : '' }}">

                <i class="bi bi-speedometer2 mr-3"></i>

                Dashboard

            </a>

            <a href="{{ route('students.index') }}"
               class="block px-6 py-3 rounded-lg transition duration-200 hover:bg-slate-800
               {{ request()->routeIs('students.*')
                    ? 'bg-slate-800 text-white font-semibold'
                    : '' }}">

                <i class="bi bi-people mr-3"></i>

                Students

            </a>

            <a href="{{ route('hostels.index') }}"
               class="block px-6 py-3 rounded-lg transition duration-200 hover:bg-slate-800
               {{ request()->routeIs('hostels.*')
                    ? 'bg-slate-800 text-white font-semibold'
                    : '' }}">

                <i class="bi bi-building mr-3"></i>

                Hostels

            </a>

            <a href="{{ route('rooms.index') }}"
               class="block px-6 py-3 rounded-lg transition duration-200 hover:bg-slate-800
               {{ request()->routeIs('rooms.*')
                    ? 'bg-slate-800 text-white font-semibold'
                    : '' }}">

                <i class="bi bi-door-open mr-3"></i>

                Rooms

            </a>

            <a href="{{ route('applications.index') }}"
               class="block px-6 py-3 rounded-lg transition duration-200 hover:bg-slate-800
               {{ request()->routeIs('applications.*')
                    ? 'bg-slate-800 text-white font-semibold'
                    : '' }}">

                <i class="bi bi-file-earmark-text mr-3"></i>

                Applications

            </a>

            <a href="{{ route('allocations.index') }}"
               class="block px-6 py-3 rounded-lg transition duration-200 hover:bg-slate-800
               {{ request()->routeIs('allocations.*')
                    ? 'bg-slate-800 text-white font-semibold'
                    : '' }}">

                <i class="bi bi-house-check mr-3"></i>

                Allocations

            </a>

            <a href="{{ route('payments.index') }}"
               class="block px-6 py-3 rounded-lg transition duration-200 hover:bg-slate-800
               {{ request()->routeIs('payments.*')
                    ? 'bg-slate-800 text-white font-semibold'
                    : '' }}">

                <i class="bi bi-credit-card mr-3"></i>

                Payments

            </a>

            <a href="{{ route('notices.index') }}"
               class="block px-6 py-3 rounded-lg transition duration-200 hover:bg-slate-800
               {{ request()->routeIs('notices.*')
                    ? 'bg-slate-800 text-white font-semibold'
                    : '' }}">

                <i class="bi bi-megaphone mr-3"></i>

                Notices

            </a>

            <a href="{{ route('reports.index') }}"
               class="block px-6 py-3 rounded-lg transition duration-200 hover:bg-slate-800
               {{ request()->routeIs('reports.*')
                    ? 'bg-slate-800 text-white font-semibold'
                    : '' }}">

                <i class="bi bi-bar-chart mr-3"></i>

                Reports

            </a>

            <a href="{{ route('settings.index') }}"
               class="block px-6 py-3 rounded-lg transition duration-200 hover:bg-slate-800
               {{ request()->routeIs('settings.*')
                    ? 'bg-slate-800 text-white font-semibold'
                    : '' }}">

                <i class="bi bi-gear mr-3"></i>

                Settings

            </a>

        </nav>

        <!-- Logout -->

        <div class="p-4">

            <form
                method="POST"
                action="{{ route('logout') }}">

                @csrf

                <button
                    type="submit"
                    class="w-full bg-red-600 hover:bg-red-700 py-3 rounded-lg transition duration-200">

                    <i class="bi bi-box-arrow-right mr-2"></i>

                    Logout

                </button>

            </form>

        </div>

    </aside>

       <!-- Main Content -->

    <main class="ml-64 flex-1">

        <!-- Top Navigation -->

        <header class="fixed top-0 left-64 right-0 bg-slate-900 text-white shadow-lg z-30">

            <div class="flex items-center justify-between px-8 py-4">

                <!-- System Title -->

                <div>

                    <h2 class="text-2xl font-bold">

                        Hostel Management System

                    </h2>

                    <p class="text-sm text-slate-300">

                        Administrator Portal

                    </p>

                </div>

                <!-- Right Side -->

                <div class="flex items-center gap-6">

                    <!-- Notification -->

<div class="relative">

<button
id="notificationButton"
class="relative p-2 rounded-lg hover:bg-slate-100 transition">

<i class="bi bi-bell text-xl"></i>

@if($unreadNotifications > 0)

<span
class="absolute -top-1 -right-1 bg-red-600 text-white text-[10px] rounded-full w-5 h-5 flex items-center justify-center">

{{ $unreadNotifications }}

</span>

@endif

</button>

<div
id="notificationDropdown"
class="hidden absolute right-0 mt-3 w-96 bg-white rounded-xl shadow-xl border border-slate-200 z-50">

<div class="flex items-center justify-between p-4 border-b">

<h3 class="font-semibold">

Notifications

</h3>

<a
href="{{ route('notifications.index') }}"
class="text-blue-600 text-sm">

View All

</a>

</div>

<div class="max-h-96 overflow-y-auto">

@forelse($notifications as $notification)

<form
    action="{{ route('notifications.read', $notification->id) }}"
    method="POST">

    @csrf

    <button
        type="submit"
        class="w-full text-left p-4 border-b hover:bg-slate-50">

        <div class="flex justify-between">

            <h4 class="font-medium">

                {{ $notification->title }}

            </h4>

            @if(!$notification->is_read)

                <span
                    class="w-2 h-2 rounded-full bg-blue-600 mt-2">
                </span>

            @endif

        </div>

        <p class="text-sm text-slate-500 mt-1">

            {{ $notification->message }}

        </p>

        <p class="text-xs text-slate-400 mt-2">

            {{ $notification->created_at->diffForHumans() }}

        </p>

    </button>

</form>

@empty

<div class="p-6 text-center text-slate-500">

    No notifications

</div>

@endforelse

</div>

</div>

</div>

                    <!-- User -->

                    <div class="flex items-center gap-3">

                        <div
                            class="w-11 h-11 rounded-full bg-indigo-600 flex items-center justify-center font-bold text-white">

                            {{ strtoupper(substr(auth()->user()->name,0,1)) }}

                        </div>

                        <div>

                            <p class="font-semibold leading-tight">

                                {{ auth()->user()->name }}

                            </p>

                            <p class="text-sm text-slate-300">

                                {{ ucfirst(auth()->user()->role) }}

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </header>

        <!-- Page -->

        <div class="pt-24 px-6 pb-6 min-h-screen">

                    @if(session('success'))

                <div
                    class="mb-6 flex items-center gap-3 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-green-700 shadow-sm">

                    <i class="bi bi-check-circle-fill text-xl"></i>

                    <span>

                        {{ session('success') }}

                    </span>

                </div>

            @endif

            @if(session('error'))

                <div
                    class="mb-6 flex items-center gap-3 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-red-700 shadow-sm">

                    <i class="bi bi-exclamation-circle-fill text-xl"></i>

                    <span>

                        {{ session('error') }}

                    </span>

                </div>

            @endif

            @if($errors->any())

                <div
                    class="mb-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4 shadow-sm">

                    <div class="flex items-center gap-3 text-red-700 mb-3">

                        <i class="bi bi-exclamation-triangle-fill text-xl"></i>

                        <span class="font-semibold">

                            Please correct the following errors.

                        </span>

                    </div>

                    <ul class="list-disc ml-10 text-red-700 space-y-1">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            {{-- Page Content --}}

            @yield('content')

        </div>

    </main>

</div>

<script>

const notificationButton =
document.getElementById('notificationButton');

const notificationDropdown =
document.getElementById('notificationDropdown');

notificationButton.addEventListener('click', function () {

notificationDropdown.classList.toggle('hidden');

});

window.addEventListener('click', function(e){

if(
!notificationButton.contains(e.target)
&&
!notificationDropdown.contains(e.target)
){

notificationDropdown.classList.add('hidden');

}

});

</script>

</body>

</html>