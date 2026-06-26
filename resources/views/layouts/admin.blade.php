<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Management System</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <div class="w-64 bg-blue-900 text-white flex flex-col min-h-screen">

        <div class="p-6 border-b border-blue-800">
            <h1 class="text-2xl font-bold">
                HMS
            </h1>

            <p class="text-sm text-gray-300">
                Hostel Management
            </p>
        </div>

        <nav class="mt-4 flex-1">

            <a href="{{ route('admin.dashboard') }}" 
            class="flex items-center gap-3 px-6 py-3 bg-blue-700">
                <i class="bi bi-speedometer2"></i>
                Dashboard
            </a>

            <a href="{{ route('students.index') }}"
               class="flex items-center gap-3 px-6 py-3 hover:bg-blue-800">

               <i class="bi bi-people"></i>

               Students

            </a>

            <a href="{{ route('hostels.index') }}"
               class="flex items-center gap-3 px-6 py-3 hover:bg-blue-800">
               <i class="bi bi-building"></i>

                Hostels

            </a>

            <a href="{{ route('rooms.index') }}"
                class="flex items-center gap-3 px-6 py-3 hover:bg-blue-800">

                 <i class="bi bi-door-open"></i>

                 Rooms

            </a>

            <a href="{{ route('applications.index') }}"
                class="flex items-center gap-3 px-6 py-3 hover:bg-blue-800">
                <i class="bi bi-file-earmark-text"></i>

               Applications
            </a>

            <a href="{{ route('allocations.index') }}"
               class="flex items-center gap-3 px-6 py-3 hover:bg-blue-800">

               <i class="bi bi-house-check"></i>

                Allocations

            </a>

            <a href="{{ route('payments.index') }}"
                class="flex items-center gap-3 px-6 py-3 hover:bg-blue-800">
                <i class="bi bi-credit-card"></i>
                Payments
            </a>

            <a href="{{ route('notices.index') }}"
               class="flex items-center gap-3 px-6 py-3 hover:bg-blue-800">
                <i class="bi bi-megaphone"></i>
                Notices
            </a>

            <a href="{{ route('reports.index') }}"
               class="flex items-center gap-3 px-6 py-3 hover:bg-blue-800">
                <i class="bi bi-bar-chart"></i>
                Reports
            </a>

            <a href="{{ route('settings.index') }}"
               class="flex items-center gap-3 px-6 py-3 hover:bg-blue-800">
                <i class="bi bi-gear"></i>
                Settings
            </a>

            <a href="#" 
            class="flex items-center gap-3 px-6 py-3 hover:bg-blue-800">
                <i class="bi bi-box-arrow-right"></i>
                Logout
            </a>

        </nav>

        <div class="p-4 border-t border-blue-800">

    <div class="bg-blue-800 rounded-xl p-4">

        <div class="flex items-center gap-3">

            <div class="w-12 h-12 rounded-full bg-white text-blue-900 flex items-center justify-center font-bold">
                A
            </div>

            <div>

                <p class="font-semibold">
                    Administrator
                </p>

                <p class="text-sm text-blue-200">
                    Super Administrator
                </p>

                <div class="flex items-center gap-2 mt-1">

                    <div class="w-2 h-2 bg-green-400 rounded-full"></div>

                    <span class="text-xs text-green-300">
                        Online
                    </span>

                </div>

            </div>

        </div>

    </div>

 </div>

    </div>

    <!-- Content -->

    <div class="flex-1">

        <div class="bg-white shadow-sm px-8 py-4 flex items-center justify-between">

    <div>
        <h2 class="text-3xl font-bold text-gray-800">
            Dashboard
        </h2>

        <p class="text-gray-500">
            Hostel Management System Version 2.0
        </p>
    </div>

    <div class="flex items-center gap-6">

        <button class="relative">
            <i class="bi bi-bell text-2xl text-gray-600"></i>

            <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs px-2 rounded-full">
                3
            </span>
        </button>

        <div class="flex items-center gap-3">

            <div class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center">
                A
            </div>

            <div>
                <p class="font-semibold">
                    Administrator
                </p>

                <p class="text-sm text-gray-500">
                    System Admin
                </p>
            </div>

        </div>

    </div>

</div>

        <div class="p-6">

            @yield('content')

        </div>

    </div>

</div>

</body>
</html>