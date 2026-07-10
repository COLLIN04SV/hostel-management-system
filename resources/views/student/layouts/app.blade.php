<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal</title>

    <link rel="stylesheet"
         href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

<div class="flex h-screen">

    {{-- Sidebar --}}

    <aside
        class="w-64 bg-slate-900 text-white flex flex-col">

        {{-- Logo --}}

        <div
            class="px-6 py-6 border-b border-slate-700">

            <p
                class="text-xs uppercase tracking-widest text-slate-400">

                Hostel Management

            </p>

            <h1
                class="text-2xl font-bold mt-1">

                Student Portal

            </h1>

        </div>

        {{-- Navigation --}}

        <nav class="flex-1 overflow-y-auto py-5">

    <a href="{{ route('student.dashboard') }}"
       class="block px-6 py-3 rounded-lg mx-2 transition duration-200 hover:bg-slate-800 {{ request()->routeIs('student.dashboard') ? 'bg-slate-800 text-white font-semibold' : '' }}">
        Dashboard
    </a>

    <a href="{{ route('student.profile') }}"
       class="block px-6 py-3 rounded-lg mx-2 transition duration-200 hover:bg-slate-800 {{ request()->routeIs('student.profile') ? 'bg-slate-800 text-white font-semibold' : '' }}">
        My Profile
    </a>

    <a href="{{ route('student.application.create') }}"
       class="block px-6 py-3 rounded-lg mx-2 transition duration-200 hover:bg-slate-800 {{ request()->routeIs('student.application.create') ? 'bg-slate-800 text-white font-semibold' : '' }}">
        Apply Hostel
    </a>

    <a href="{{ route('student.applications.index') }}"
       class="block px-6 py-3 rounded-lg mx-2 transition duration-200 hover:bg-slate-800 {{ request()->routeIs('student.applications.index') ? 'bg-slate-800 text-white font-semibold' : '' }}">
        My Applications
    </a>

    <a href="{{ route('student.room') }}"
       class="block px-6 py-3 rounded-lg mx-2 transition duration-200 hover:bg-slate-800 {{ request()->routeIs('student.room') ? 'bg-slate-800 text-white font-semibold' : '' }}">
        My Room
    </a>

    <a href="{{ route('student.payments') }}"
       class="block px-6 py-3 rounded-lg mx-2 transition duration-200 hover:bg-slate-800 {{ request()->routeIs('student.payments') ? 'bg-slate-800 text-white font-semibold' : '' }}">
        Payments
    </a>

    <a href="{{ route('student.receipts.index') }}"
       class="block px-6 py-3 rounded-lg mx-2 transition duration-200 hover:bg-slate-800 {{ request()->routeIs('student.receipts.index') ? 'bg-slate-800 text-white font-semibold' : '' }}">
        Receipts
    </a>

    <a href="{{ route('student.notices') }}"
       class="block px-6 py-3 rounded-lg mx-2 transition duration-200 hover:bg-slate-800 {{ request()->routeIs('student.notices') ? 'bg-slate-800 text-white font-semibold' : '' }}">
        Notices
    </a>

    <a href="{{ route('student.support') }}"
       class="block px-6 py-3 rounded-lg mx-2 transition duration-200 hover:bg-slate-800 {{ request()->routeIs('student.support*') ? 'bg-slate-800 text-white font-semibold' : '' }}">
        Support
    </a>

    <a href="{{ route('student.settings') }}"
       class="block px-6 py-3 rounded-lg mx-2 transition duration-200 hover:bg-slate-800 {{ request()->routeIs('student.settings*') ? 'bg-slate-800 text-white font-semibold' : '' }}">
        Settings
    </a>

</nav>

        {{-- Logout --}}

        <div
            class="border-t border-slate-700 p-4">

            <form
                method="POST"
                action="{{ route('logout') }}">

                @csrf

                <button
    type="submit"
    class="w-full bg-red-600 hover:bg-red-700 text-white font-medium rounded-xl py-3 transition duration-200">

    Logout

</button>
            </form>

        </div>

    </aside>

    {{-- Main Area --}}

    <div class="flex-1 flex flex-col">

        {{-- Top Navigation --}}

        <header class="bg-slate-900 text-white px-8 py-5 flex justify-between items-center">

    <h2 class="text-2xl font-semibold">

        Student Portal

    </h2>

    <div class="flex items-center gap-5">

        <div class="relative">

    <button
        id="notificationButton"
        type="button"
        class="relative p-2 rounded-lg hover:bg-slate-800 transition">

        <i class="bi bi-bell-fill text-2xl text-white"></i>

        @if(isset($unreadNotices) && $unreadNotices > 0)

            <span
                class="absolute -top-1 -right-1 bg-red-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">

                {{ $unreadNotices }}

            </span>

        @endif

    </button>

    <div
        id="notificationDropdown"
        class="hidden absolute right-0 mt-3 w-80 bg-white rounded-xl shadow-xl border border-gray-200 z-50">

        <div class="p-4 border-b">

            <h3 class="font-semibold text-gray-800">

                Notifications

            </h3>

        </div>

        <div class="max-h-80 overflow-y-auto">

            @forelse($latestNotices ?? [] as $notice)

                <a
                    href="{{ route('student.notices.show',$notice) }}"
                    class="block px-4 py-3 hover:bg-gray-50 border-b">

                    <p class="font-medium text-gray-800">

                        {{ $notice->title }}

                    </p>

                    <p class="text-sm text-gray-500 mt-1">

                        {{ \Carbon\Carbon::parse($notice->created_at)->diffForHumans() }}

                    </p>

                </a>

            @empty

                <div class="p-6 text-center text-gray-500">

                    No notifications

                </div>

            @endforelse

        </div>

        <div class="p-3 border-t text-center">

            <a
                href="{{ route('student.notices') }}"
                class="text-indigo-600 hover:text-indigo-800 font-medium">

                View All Notices

            </a>

        </div>

    </div>

</div>
        <div class="flex items-center gap-4">

            <div class="w-11 h-11 rounded-full bg-indigo-600 flex items-center justify-center font-bold text-lg">

                {{ strtoupper(substr(auth()->user()->name,0,1)) }}

            </div>

            <div class="leading-tight">

                <p class="font-semibold">

                    {{ auth()->user()->name }}

                </p>

                <p class="text-sm text-slate-300">

                    {{ optional(auth()->user()->student)->registration_number }}

                </p>

            </div>

        </div>

    </div>

</header>

        {{-- Page Content --}}

        <main class="flex-1 overflow-y-auto p-8">

    @if(session('success'))

        <div class="mb-6 bg-green-100 border border-green-300 text-green-700 px-5 py-4 rounded-xl">

            {{ session('success') }}

        </div>

    @endif

    @if(session('error'))

        <div class="mb-6 bg-red-100 border border-red-300 text-red-700 px-5 py-4 rounded-xl">

            {{ session('error') }}

        </div>

    @endif

    @if($errors->any())

        <div class="mb-6 bg-red-100 border border-red-300 text-red-700 px-5 py-4 rounded-xl">

            <ul class="list-disc list-inside">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    @yield('student-content')

</main>
    </div>

</div>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const button = document.getElementById('notificationButton');
    const dropdown = document.getElementById('notificationDropdown');

    if (!button || !dropdown) return;

    button.addEventListener('click', function (e) {

        e.stopPropagation();

        dropdown.classList.toggle('hidden');

    });

    document.addEventListener('click', function () {

        dropdown.classList.add('hidden');

    });

    dropdown.addEventListener('click', function (e) {

        e.stopPropagation();

    });

});

</script>

</body>
</html>