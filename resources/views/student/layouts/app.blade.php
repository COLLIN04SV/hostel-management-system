<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-indigo-900 text-white">

        <div class="p-6 text-2xl font-bold border-b border-indigo-700">
            Student Portal
        </div>

        <nav class="mt-6">

            <a href="{{ route('student.dashboard') }}"
               class="block px-6 py-3 hover:bg-indigo-700">
                Dashboard
            </a>

            <a href="{{ route('student.profile') }}"
               class="block px-6 py-3 hover:bg-indigo-700">
                My Profile
            </a>

            <a href="{{ route('student.application.create') }}"
               class="block px-6 py-3 hover:bg-indigo-700">
                Apply Hostel
            </a>

            <a href="{{ route('student.applications.index') }}"
               class="block px-6 py-3 hover:bg-indigo-700">
                My Applications
            </a>

            <a href="{{ route('student.room') }}"
               class="block px-6 py-3 hover:bg-indigo-700">
                My Room
            </a>

            <a href="{{ route('student.payments') }}"
               class="block px-6 py-3 hover:bg-indigo-700">
                Payments
            </a>

            <a href="{{ route('student.receipts') }}"
               class="block px-6 py-3 hover:bg-indigo-700">
                Receipts
            </a>

            <a href="{{ route('student.notices') }}"
               class="block px-6 py-3 hover:bg-indigo-700">
                Notices
            </a>

            <a href="{{ route('student.support') }}"
               class="block px-6 py-3 hover:bg-indigo-700">
                Support
            </a>

            <a href="{{ route('student.settings') }}"
               class="block px-6 py-3 hover:bg-indigo-700">
                Settings
            </a>

        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1">

        <!-- Navbar -->
        <header class="bg-white shadow px-6 py-4 flex justify-between">

            <h1 class="text-xl font-bold">
                @yield('title')
            </h1>

            <div>
                {{ auth()->user()->name }}
            </div>

        </header>

        <!-- Page Content -->
        <main class="p-6">
            @yield('student-content')
        </main>

    </div>

</div>

</body>
</html>