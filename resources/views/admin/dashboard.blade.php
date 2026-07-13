@extends('layouts.admin')

@section('title','Admin Dashboard')

@section('page-title','Dashboard')

@section('page-description','Hostel Management Overview')

@section('content')

<x-admin.page-header
    title="Dashboard"
    subtitle="Welcome back, {{ auth()->user()->name }}">

    <div class="text-right">

        <p class="text-xs text-slate-500">
            {{ now()->format('l') }}
        </p>

        <p class="text-sm font-semibold text-slate-700">
            {{ now()->format('d M Y') }}
        </p>

    </div>

</x-admin.page-header>


{{-- Statistics Cards --}}

<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

    <x-admin.stat-card
        title="Students"
        :value="$totalStudents"
        icon="bi-people-fill"
        color="blue"/>

    <x-admin.stat-card
        title="Hostels"
        :value="$totalHostels"
        icon="bi-building"
        color="green"/>

    <x-admin.stat-card
        title="Rooms"
        :value="$totalRooms"
        icon="bi-door-open-fill"
        color="yellow"/>

    <x-admin.stat-card
        title="Active Allocations"
        :value="$activeAllocations"
        icon="bi-house-check-fill"
        color="indigo"/>

</div>


<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

    <x-admin.stat-card
        title="Revenue Collected"
        :value="'KSh '.number_format($totalRevenue)"
        icon="bi-cash-stack"
        color="green"/>

    <x-admin.stat-card
        title="Outstanding Balance"
        :value="'KSh '.number_format($outstandingBalance)"
        icon="bi-wallet2"
        color="red"/>

    <x-admin.stat-card
        title="Accounts Cleared"
        :value="$completedAccounts"
        icon="bi-check-circle-fill"
        color="green"/>

    <x-admin.stat-card
        title="Pending Accounts"
        :value="$pendingAccounts + $partialAccounts"
        icon="bi-clock-history"
        color="yellow"/>

</div>


{{-- Quick Actions --}}

<x-admin.card>

    <div class="flex items-center justify-between mb-6">

        <div>

            <h2 class="text-lg font-semibold text-slate-800">

                Quick Actions

            </h2>

            <p class="text-sm text-slate-500">

                Frequently used shortcuts.

            </p>

        </div>

    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-5 gap-5">

        <a
            href="{{ route('students.create') }}"
            class="rounded-xl border border-slate-200 hover:border-blue-300 hover:bg-blue-50 transition p-5 text-center">

            <div class="w-12 h-12 mx-auto rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center">

                <i class="bi bi-person-plus-fill text-xl"></i>

            </div>

            <p class="mt-3 font-medium">

                Add Student

            </p>

        </a>

        <a
            href="{{ route('hostels.create') }}"
            class="rounded-xl border border-slate-200 hover:border-green-300 hover:bg-green-50 transition p-5 text-center">

            <div class="w-12 h-12 mx-auto rounded-xl bg-green-100 text-green-600 flex items-center justify-center">

                <i class="bi bi-building-add text-xl"></i>

            </div>

            <p class="mt-3 font-medium">

                Add Hostel

            </p>

        </a>

        <a
            href="{{ route('rooms.create') }}"
            class="rounded-xl border border-slate-200 hover:border-yellow-300 hover:bg-yellow-50 transition p-5 text-center">

            <div class="w-12 h-12 mx-auto rounded-xl bg-yellow-100 text-yellow-600 flex items-center justify-center">

                <i class="bi bi-door-open-fill text-xl"></i>

            </div>

            <p class="mt-3 font-medium">

                Add Room

            </p>

        </a>

        <a
            href="{{ route('allocations.create') }}"
            class="rounded-xl border border-slate-200 hover:border-indigo-300 hover:bg-indigo-50 transition p-5 text-center">

            <div class="w-12 h-12 mx-auto rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center">

                <i class="bi bi-house-check-fill text-xl"></i>

            </div>

            <p class="mt-3 font-medium">

                Allocate Room

            </p>

        </a>

        <a
            href="{{ route('payments.create') }}"
            class="rounded-xl border border-slate-200 hover:border-emerald-300 hover:bg-emerald-50 transition p-5 text-center">

            <div class="w-12 h-12 mx-auto rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center">

                <i class="bi bi-cash-coin text-xl"></i>

            </div>

            <p class="mt-3 font-medium">

                Record Payment

            </p>

        </a>

    </div>

</x-admin.card>


<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">

    {{-- Occupancy Overview --}}

    <x-admin.card>

        <div class="flex justify-between items-center mb-6">

            <div>

                <h2 class="text-lg font-semibold">

                    Occupancy Overview

                </h2>

                <p class="text-sm text-slate-500">

                    Hostel bed utilization

                </p>

            </div>

            <i class="bi bi-bar-chart-fill text-2xl text-blue-600"></i>

        </div>

        <div class="mb-6">

            <div class="flex justify-between text-sm mb-2">

                <span>Occupancy Rate</span>

                <strong>{{ $occupancyRate }}%</strong>

            </div>

            <div class="w-full bg-slate-200 rounded-full h-3">

                <div
                    class="bg-blue-600 h-3 rounded-full"
                    style="width:{{ $occupancyRate }}%">

                </div>

            </div>

        </div>

        <div class="grid grid-cols-3 gap-4">

            <div class="text-center">

                <p class="text-xs text-slate-500">

                    Occupied

                </p>

                <h3 class="text-2xl font-bold text-blue-600">

                    {{ $occupiedBeds }}

                </h3>

            </div>

            <div class="text-center">

                <p class="text-xs text-slate-500">

                    Vacant

                </p>

                <h3 class="text-2xl font-bold text-green-600">

                    {{ $vacantBeds }}

                </h3>

            </div>

            <div class="text-center">

                <p class="text-xs text-slate-500">

                    Capacity

                </p>

                <h3 class="text-2xl font-bold">

                    {{ $totalBeds }}

                </h3>

            </div>

        </div>

    </x-admin.card>


    {{-- Financial Overview --}}

    <x-admin.card>

        <div class="flex justify-between items-center mb-6">

            <div>

                <h2 class="text-lg font-semibold">

                    Financial Overview

                </h2>

                <p class="text-sm text-slate-500">

                    Current payment status

                </p>

            </div>

            <i class="bi bi-wallet2 text-2xl text-green-600"></i>

        </div>

                <div class="space-y-5">

            <div class="flex justify-between items-center border-b border-slate-200 pb-4">

                <div>

                    <p class="text-sm text-slate-500">

                        Revenue Collected

                    </p>

                    <h3 class="text-2xl font-bold text-green-600 mt-1">

                        KSh {{ number_format($totalRevenue) }}

                    </h3>

                </div>

                <div class="w-12 h-12 rounded-xl bg-green-100 text-green-600 flex items-center justify-center">

                    <i class="bi bi-cash-stack"></i>

                </div>

            </div>

            <div class="flex justify-between items-center border-b border-slate-200 pb-4">

                <div>

                    <p class="text-sm text-slate-500">

                        Outstanding Balance

                    </p>

                    <h3 class="text-2xl font-bold text-red-600 mt-1">

                        KSh {{ number_format($outstandingBalance) }}

                    </h3>

                </div>

                <div class="w-12 h-12 rounded-xl bg-red-100 text-red-600 flex items-center justify-center">

                    <i class="bi bi-wallet2"></i>

                </div>

            </div>

            <div class="grid grid-cols-3 gap-4">

                <div class="text-center">

                    <p class="text-xs text-slate-500">

                        Completed

                    </p>

                    <h3 class="text-2xl font-bold text-green-600">

                        {{ $completedAccounts }}

                    </h3>

                </div>

                <div class="text-center">

                    <p class="text-xs text-slate-500">

                        Partial

                    </p>

                    <h3 class="text-2xl font-bold text-yellow-500">

                        {{ $partialAccounts }}

                    </h3>

                </div>

                <div class="text-center">

                    <p class="text-xs text-slate-500">

                        Pending

                    </p>

                    <h3 class="text-2xl font-bold text-red-600">

                        {{ $pendingAccounts }}

                    </h3>

                </div>

            </div>

        </div>

    </x-admin.card>

</div>


<div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mt-8">

    {{-- Recent Payments --}}

    <x-admin.card>

        <div class="flex items-center justify-between mb-5">

            <h2 class="text-lg font-semibold flex items-center gap-2">

                <i class="bi bi-cash-stack text-green-600"></i>

                Recent Payments

            </h2>

            <a
                href="{{ route('payments.index') }}"
                class="text-sm text-blue-600">

                View All

            </a>

        </div>

        @forelse($recentPayments as $payment)

            <div class="flex justify-between items-center py-4 border-b border-slate-100 last:border-0">

                <div>

                    <p class="font-medium">

                        {{ $payment->student->user->name }}

                    </p>

                    <p class="text-xs text-slate-500">

                        {{ $payment->student->registration_number }}

                    </p>

                    <p class="text-xs text-slate-400">

                        {{ $payment->payment_date }}

                    </p>

                </div>

                <div class="text-right">

                    <p class="font-semibold text-green-600">

                        KSh {{ number_format($payment->amount) }}

                    </p>

                    @if($payment->status=='Completed')

                        <x-admin.badge
                            type="success"
                            text="Completed"/>

                    @else

                        <x-admin.badge
                            type="warning"
                            text="Pending"/>

                    @endif

                </div>

            </div>

        @empty

            <x-admin.empty-state
                icon="bi-cash-stack"
                title="No Payments"
                message="Payment records will appear here."/>

        @endforelse

    </x-admin.card>



    {{-- Recent Allocations --}}

    <x-admin.card>

        <div class="flex items-center justify-between mb-5">

            <h2 class="text-lg font-semibold flex items-center gap-2">

                <i class="bi bi-house-check-fill text-indigo-600"></i>

                Recent Allocations

            </h2>

            <a
                href="{{ route('allocations.index') }}"
                class="text-sm text-blue-600">

                View All

            </a>

        </div>

        @forelse($recentAllocations as $allocation)

            <div class="flex justify-between items-center py-4 border-b border-slate-100 last:border-0">

                <div>

                    <p class="font-medium">

                        {{ $allocation->student->user->name }}

                    </p>

                    <p class="text-xs text-slate-500">

                        Room {{ $allocation->room->room_number }}

                    </p>

                    <p class="text-xs text-slate-400">

                        {{ $allocation->allocated_date }}

                    </p>

                </div>

                <div>

                    @if($allocation->status=='Active')

                        <x-admin.badge
                            type="success"
                            text="Active"/>

                    @else

                        <x-admin.badge
                            type="warning"
                            text="{{ $allocation->status }}"/>

                    @endif

                </div>

            </div>

        @empty

            <x-admin.empty-state
                icon="bi-house-check"
                title="No Allocations"
                message="Room allocations will appear here."/>

        @endforelse

    </x-admin.card>

</div>

<div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mt-8">

    {{-- Recent Applications --}}

    <x-admin.card>

        <div class="flex items-center justify-between mb-5">

            <h2 class="text-lg font-semibold flex items-center gap-2">

                <i class="bi bi-file-earmark-text text-blue-600"></i>

                Recent Applications

            </h2>

            <a
                href="{{ route('applications.index') }}"
                class="text-sm text-blue-600">

                View All

            </a>

        </div>

        @forelse($recentApplications as $application)

            <div class="flex justify-between items-center py-4 border-b border-slate-100 last:border-0">

                <div>

                    <p class="font-medium">

                        {{ $application->student->user->name }}

                    </p>

                    <p class="text-xs text-slate-500">

                        {{ $application->hostel->name }}

                    </p>

                    <p class="text-xs text-slate-400">

                        {{ $application->created_at->diffForHumans() }}

                    </p>

                </div>

                <div>

                    @if($application->status=='Approved')

                        <x-admin.badge
                            type="success"
                            text="Approved"/>

                    @elseif($application->status=='Pending')

                        <x-admin.badge
                            type="warning"
                            text="Pending"/>

                    @elseif($application->status=='Allocated')

                        <x-admin.badge
                            type="info"
                            text="Allocated"/>

                    @else

                        <x-admin.badge
                            type="danger"
                            text="{{ $application->status }}"/>

                    @endif

                </div>

            </div>

        @empty

            <x-admin.empty-state
                icon="bi-file-earmark-text"
                title="No Applications"
                message="Applications will appear here."/>

        @endforelse

    </x-admin.card>



    {{-- Latest Notices --}}

    <x-admin.card>

        <div class="flex items-center justify-between mb-5">

            <h2 class="text-lg font-semibold flex items-center gap-2">

                <i class="bi bi-megaphone-fill text-orange-500"></i>

                Latest Notices

            </h2>

            <a
                href="{{ route('notices.index') }}"
                class="text-sm text-blue-600">

                View All

            </a>

        </div>

        @forelse($recentNotices as $notice)

            <div class="py-4 border-b border-slate-100 last:border-0">

                <h3 class="font-semibold text-slate-800">

                    {{ $notice->title }}

                </h3>

                <p class="text-sm text-slate-500 mt-2">

                    {{ \Illuminate\Support\Str::limit($notice->message,80) }}

                </p>

                <p class="text-xs text-slate-400 mt-3">

                    {{ $notice->created_at->diffForHumans() }}

                </p>

            </div>

        @empty

            <x-admin.empty-state
                icon="bi-megaphone"
                title="No Notices"
                message="Published notices will appear here."/>

        @endforelse

    </x-admin.card>

</div>



{{-- Footer Summary --}}

<div class="mt-8">

    <x-admin.card>

        <div class="flex flex-col lg:flex-row justify-between items-center gap-6">

            <div>

                <h2 class="text-xl font-semibold text-slate-800">

                    Hostel Management System

                </h2>

                <p class="text-sm text-slate-500 mt-1">

                    Real-time overview of student accommodation, finances and hostel operations.

                </p>

            </div>

            <div class="grid grid-cols-3 gap-8 text-center">

                <div>

                    <p class="text-xs text-slate-500">

                        Students

                    </p>

                    <h3 class="text-2xl font-bold text-blue-600">

                        {{ $totalStudents }}

                    </h3>

                </div>

                <div>

                    <p class="text-xs text-slate-500">

                        Revenue

                    </p>

                    <h3 class="text-2xl font-bold text-green-600">

                        {{ number_format($totalRevenue) }}

                    </h3>

                </div>

                <div>

                    <p class="text-xs text-slate-500">

                        Occupancy

                    </p>

                    <h3 class="text-2xl font-bold text-indigo-600">

                        {{ $occupancyRate }}%

                    </h3>

                </div>

            </div>

        </div>

    </x-admin.card>

</div>

@endsection