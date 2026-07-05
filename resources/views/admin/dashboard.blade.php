@extends('layouts.admin')

@section('page-title','Dashboard')

@section('content')

<div class="space-y-8">

    <div class="flex justify-between items-center">

    <div>

        <h1 class="text-3xl font-bold text-gray-800">

            Welcome, {{ auth()->user()->name }}

        </h1>

        <p class="text-gray-500 mt-2">

            Here's what's happening in your hostel today.

        </p>

    </div>

    <div class="text-right">

        <p class="text-gray-500">

            {{ now()->format('l') }}

        </p>

        <h3 class="font-bold">

            {{ now()->format('d M Y') }}

        </h3>

    </div>

  </div>

    {{-- Statistics --}}

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

    <div class="bg-gradient-to-r from-blue-600 to-blue-500 rounded-2xl shadow-lg p-6 text-white">

        <div class="flex justify-between items-center">

            <div>

                <p class="text-blue-100">
                    Students
                </p>

                <h2 class="text-4xl font-bold mt-2">
                    {{ $totalStudents }}
                </h2>

            </div>

            <i class="bi bi-people-fill text-5xl opacity-40"></i>

        </div>

    </div>

    <div class="bg-gradient-to-r from-purple-600 to-purple-500 rounded-2xl shadow-lg p-6 text-white">

        <div class="flex justify-between items-center">

            <div>

                <p class="text-purple-100">
                    Hostels
                </p>

                <h2 class="text-4xl font-bold mt-2">
                    {{ $totalHostels }}
                </h2>

            </div>

            <i class="bi bi-building text-5xl opacity-40"></i>

        </div>

    </div>

    <div class="bg-gradient-to-r from-orange-500 to-orange-400 rounded-2xl shadow-lg p-6 text-white">

        <div class="flex justify-between items-center">

            <div>

                <p class="text-orange-100">
                    Rooms
                </p>

                <h2 class="text-4xl font-bold mt-2">
                    {{ $totalRooms }}
                </h2>

            </div>

            <i class="bi bi-door-open-fill text-5xl opacity-40"></i>

        </div>

    </div>

    <div class="bg-gradient-to-r from-green-600 to-emerald-500 rounded-2xl shadow-lg p-6 text-white">

        <div class="flex justify-between items-center">

            <div>

                <p class="text-green-100">
                    Revenue
                </p>

                <h2 class="text-3xl font-bold mt-2">
                    KSh {{ number_format($totalRevenue) }}
                </h2>

            </div>

            <i class="bi bi-cash-stack text-5xl opacity-40"></i>

        </div>

    </div>

</div>

{{-- Quick Actions --}}

<div class="bg-white rounded-2xl shadow-sm p-6 mt-8">

    <div class="flex justify-between items-center mb-6">

        <div>

            <h2 class="text-xl font-bold">
                Quick Actions
            </h2>

            <p class="text-gray-500 text-sm">
                Frequently used administrative tasks
            </p>

        </div>

    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5">

        <a href="{{ route('students.create') }}"
           class="bg-blue-50 hover:bg-blue-100 transition rounded-xl p-5 text-center">

            <i class="bi bi-person-plus-fill text-3xl text-blue-600"></i>

            <p class="mt-3 font-semibold">
                Add Student
            </p>

        </a>

        <a href="{{ route('hostels.create') }}"
           class="bg-purple-50 hover:bg-purple-100 transition rounded-xl p-5 text-center">

            <i class="bi bi-building-add text-3xl text-purple-600"></i>

            <p class="mt-3 font-semibold">
                Add Hostel
            </p>

        </a>

        <a href="{{ route('rooms.create') }}"
           class="bg-orange-50 hover:bg-orange-100 transition rounded-xl p-5 text-center">

            <i class="bi bi-door-open-fill text-3xl text-orange-600"></i>

            <p class="mt-3 font-semibold">
                Add Room
            </p>

        </a>

        <a href="{{ route('allocations.create') }}"
           class="bg-green-50 hover:bg-green-100 transition rounded-xl p-5 text-center">

            <i class="bi bi-house-check-fill text-3xl text-green-600"></i>

            <p class="mt-3 font-semibold">
                Allocate Room
            </p>

        </a>

        <a href="{{ route('payments.create') }}"
           class="bg-emerald-50 hover:bg-emerald-100 transition rounded-xl p-5 text-center">

            <i class="bi bi-cash-coin text-3xl text-emerald-600"></i>

            <p class="mt-3 font-semibold">
                Record Payment
            </p>

        </a>

    </div>

</div>

{{-- Recent Activity --}}

<div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mt-8">

    {{-- Recent Applications --}}

    <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-lg transition duration-300">

        <div class="flex justify-between items-center mb-5">

            <h2 class="text-lg font-bold flex items-center gap-2">

               <i class="bi bi-file-earmark-text text-blue-600"></i>

                Recent Applications

            </h2>

            <a href="{{ route('applications.index') }}"
               class="text-blue-600 text-sm">
                View All
            </a>

        </div>

        @forelse($recentApplications as $application)

            <div class="border-b py-3">

                <div class="font-semibold">

                    {{ $application->student->user->name }}

                </div>

                <div class="text-sm text-gray-500">

                    {{ $application->hostel->name }}

                </div>

                <div class="mt-2">

    @if($application->status == 'Approved')

        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs">
            Approved
        </span>

    @elseif($application->status == 'Rejected')

        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs">
            Rejected
        </span>

    @else

        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs">
            Pending
        </span>

    @endif

</div>

                <div class="text-xs text-gray-400">

                    {{ $application->created_at->diffForHumans() }}

                </div>

            </div>

        @empty

            <div class="text-center py-8">

               <i class="bi bi-inbox text-5xl text-gray-300"></i>

               <p class="text-gray-400 mt-3">

                No recent applications found.

               </p>

            </div>

        @endforelse

    </div>


    {{-- Recent Payments --}}

    <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-lg transition duration-300">

        <div class="flex justify-between items-center mb-5">

            <h2 class="text-lg font-bold flex items-center gap-2">

               <i class="bi bi-cash-stack text-green-600"></i>

                Recent Payments

            </h2>

            <a href="{{ route('payments.index') }}"
               class="text-blue-600 text-sm">
                View All
            </a>

        </div>

        @forelse($recentPayments as $payment)

            <div class="border-b py-3">

                <div class="font-semibold">

                    {{ $payment->student->user->name }}

                </div>

                <div class="text-sm text-green-600">

                    KSh {{ number_format($payment->amount) }}

                </div>

                <div class="mt-2">

    @if($payment->status == 'Paid')

        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs">
            Paid
        </span>

    @elseif($payment->status == 'Pending')

        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs">
            Pending
        </span>

    @else

        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs">
            Failed
        </span>

    @endif

</div>

                <div class="text-xs text-gray-400">

                    {{ $payment->created_at->diffForHumans() }}

                </div>

            </div>

        @empty

            <div class="text-center py-8">

               <i class="bi bi-inbox text-5xl text-gray-300"></i>

               <p class="text-gray-400 mt-3">

                No recent payments found.

               </p>

            </div>

        @endforelse

    </div>


    {{-- Latest Notices --}}

    <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-lg transition duration-300">

        <div class="flex justify-between items-center mb-5">

            <h2 class="text-lg font-bold flex items-center gap-2">

              <i class="bi bi-megaphone-fill text-orange-500"></i>

               Latest Notices

            </h2>

            <a href="{{ route('notices.index') }}"
               class="text-blue-600 text-sm">
                View All
            </a>

        </div>

        @forelse($recentNotices as $notice)

            <div class="border-b py-3">

                <div class="font-semibold">

                    {{ $notice->title }}

                </div>

                <div class="text-sm text-gray-500">

                    {{ \Illuminate\Support\Str::limit($notice->message,60) }}

                </div>

                <div class="text-xs text-gray-400">

                    {{ $notice->created_at->diffForHumans() }}

                </div>

            </div>

        @empty

            <div class="text-center py-8">

               <i class="bi bi-inbox text-5xl text-gray-300"></i>

               <p class="text-gray-400 mt-3">

                No recent notices found.

               </p>

            </div>

        @endforelse

    </div>

</div>

{{-- System Overview --}}

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">

    {{-- Occupancy Summary --}}
    <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-lg transition duration-300">

        <h2 class="text-xl font-bold mb-6">
            Occupancy Summary
        </h2>

        <div class="space-y-5">

            <div>

                <div class="flex justify-between mb-2">

                    <span class="text-gray-600">
                        Bed Occupancy
                    </span>

                    <span class="font-semibold">
                        {{ $occupancyRate }}%
                    </span>

                </div>

                <div class="w-full bg-gray-200 rounded-full h-3">

                    <div
                        class="bg-blue-600 h-3 rounded-full"
                        style="width: {{ $occupancyRate }}%">
                    </div>

                </div>

            </div>

            <div class="grid grid-cols-3 gap-4 text-center">

                <div>

                    <p class="text-gray-500 text-sm">
                        Occupied
                    </p>

                    <h3 class="text-2xl font-bold text-blue-600">
                        {{ $occupiedBeds }}
                    </h3>

                </div>

                <div>

                    <p class="text-gray-500 text-sm">
                        Vacant
                    </p>

                    <h3 class="text-2xl font-bold text-green-600">
                        {{ $vacantBeds }}
                    </h3>

                </div>

                <div>

                    <p class="text-gray-500 text-sm">
                        Capacity
                    </p>

                    <h3 class="text-2xl font-bold">
                        {{ $totalBeds }}
                    </h3>

                </div>

            </div>

        </div>

    </div>

    {{-- Financial Summary --}}
    <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-lg transition duration-300">

        <h2 class="text-xl font-bold mb-6">
            Financial Summary
        </h2>

        <div class="space-y-5">

            <div class="flex justify-between items-center border-b pb-4">

                <div>

                    <p class="text-gray-500">
                        Total Revenue
                    </p>

                    <h3 class="text-3xl font-bold text-green-600">

                        KSh {{ number_format($totalRevenue) }}

                    </h3>

                </div>

                <i class="bi bi-cash-stack text-5xl text-green-500"></i>

            </div>

            <div class="flex justify-between items-center">

                <div>

                    <p class="text-gray-500">
                        Pending Payments
                    </p>

                    <h3 class="text-3xl font-bold text-orange-500">

                        KSh {{ number_format($pendingPayments) }}

                    </h3>

                </div>

                <i class="bi bi-clock-history text-5xl text-orange-400"></i>

            </div>

        </div>

    </div>

</div>

</div>

@endsection