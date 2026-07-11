@extends('layouts.admin')

@section('page-title','Dashboard')

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


{{-- Statistics --}}

<x-admin.stats-grid>

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
        title="Revenue"
        :value="'KSh '.number_format($totalRevenue)"
        icon="bi-cash-stack"
        color="info"/>

</x-admin.stats-grid>


{{-- Quick Actions --}}

<x-admin.card>

    <div class="flex items-center justify-between mb-5">

        <div>

            <h2 class="text-base font-semibold text-slate-800">

                Quick Actions

            </h2>

            <p class="text-sm text-slate-500">

                Frequently used administrative shortcuts.

            </p>

        </div>

    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">

        <a
            href="{{ route('students.create') }}"
            class="group rounded-xl border border-slate-200 bg-slate-50 hover:bg-blue-50 hover:border-blue-200 transition p-4 text-center">

            <div class="w-11 h-11 mx-auto rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center">

                <i class="bi bi-person-plus-fill text-lg"></i>

            </div>

            <p class="mt-3 text-sm font-medium text-slate-700 group-hover:text-blue-700">

                Add Student

            </p>

        </a>

        <a
            href="{{ route('hostels.create') }}"
            class="group rounded-xl border border-slate-200 bg-slate-50 hover:bg-green-50 hover:border-green-200 transition p-4 text-center">

            <div class="w-11 h-11 mx-auto rounded-xl bg-green-100 text-green-600 flex items-center justify-center">

                <i class="bi bi-building-add text-lg"></i>

            </div>

            <p class="mt-3 text-sm font-medium text-slate-700 group-hover:text-green-700">

                Add Hostel

            </p>

        </a>

        <a
            href="{{ route('rooms.create') }}"
            class="group rounded-xl border border-slate-200 bg-slate-50 hover:bg-yellow-50 hover:border-yellow-200 transition p-4 text-center">

            <div class="w-11 h-11 mx-auto rounded-xl bg-yellow-100 text-yellow-600 flex items-center justify-center">

                <i class="bi bi-door-open-fill text-lg"></i>

            </div>

            <p class="mt-3 text-sm font-medium text-slate-700 group-hover:text-yellow-700">

                Add Room

            </p>

        </a>

        <a
            href="{{ route('allocations.create') }}"
            class="group rounded-xl border border-slate-200 bg-slate-50 hover:bg-indigo-50 hover:border-indigo-200 transition p-4 text-center">

            <div class="w-11 h-11 mx-auto rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center">

                <i class="bi bi-house-check-fill text-lg"></i>

            </div>

            <p class="mt-3 text-sm font-medium text-slate-700 group-hover:text-indigo-700">

                Allocate Room

            </p>

        </a>

        <a
            href="{{ route('payments.create') }}"
            class="group rounded-xl border border-slate-200 bg-slate-50 hover:bg-emerald-50 hover:border-emerald-200 transition p-4 text-center">

            <div class="w-11 h-11 mx-auto rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center">

                <i class="bi bi-cash-coin text-lg"></i>

            </div>

            <p class="mt-3 text-sm font-medium text-slate-700 group-hover:text-emerald-700">

                Record Payment

            </p>

        </a>

    </div>

</x-admin.card>


{{-- Recent Activity --}}

<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

    {{-- Recent Applications --}}
    <x-admin.card>

        <div class="flex items-center justify-between mb-5">

            <h2 class="text-base font-semibold flex items-center gap-2">

                <i class="bi bi-file-earmark-text text-blue-600"></i>

                Recent Applications

            </h2>

            <a
                href="{{ route('applications.index') }}"
                class="text-sm text-blue-600 hover:text-blue-700">

                View All

            </a>

        </div>

        @forelse($recentApplications as $application)

            <div class="flex justify-between items-center py-3 border-b border-slate-100 last:border-0">

                <div>

                    <p class="font-medium text-sm">

                        {{ $application->student->user->name }}

                    </p>

                    <p class="text-xs text-slate-500 mt-1">

                        {{ $application->hostel->name }}

                    </p>

                    <p class="text-xs text-slate-400 mt-1">

                        {{ $application->created_at->diffForHumans() }}

                    </p>

                </div>

                <div>

                    @if($application->status=='Approved')

                        <x-admin.badge
                            type="success"
                            text="Approved"/>

                    @elseif($application->status=='Rejected')

                        <x-admin.badge
                            type="danger"
                            text="Rejected"/>

                    @else

                        <x-admin.badge
                            type="warning"
                            text="Pending"/>

                    @endif

                </div>

            </div>

        @empty

            <x-admin.empty-state
                icon="bi-file-earmark-text"
                title="No Applications"
                message="Recent hostel applications will appear here."/>

        @endforelse

    </x-admin.card>


    {{-- Recent Payments --}}
    <x-admin.card>

        <div class="flex items-center justify-between mb-5">

            <h2 class="text-base font-semibold flex items-center gap-2">

                <i class="bi bi-cash-stack text-green-600"></i>

                Recent Payments

            </h2>

            <a
                href="{{ route('payments.index') }}"
                class="text-sm text-blue-600 hover:text-blue-700">

                View All

            </a>

        </div>

        @forelse($recentPayments as $payment)

            <div class="flex justify-between items-center py-3 border-b border-slate-100 last:border-0">

                <div>

                    <p class="font-medium text-sm">

                        {{ $payment->student->user->name }}

                    </p>

                    <p class="text-xs text-green-600 font-semibold mt-1">

                        KSh {{ number_format($payment->amount) }}

                    </p>

                    <p class="text-xs text-slate-400 mt-1">

                        {{ $payment->created_at->diffForHumans() }}

                    </p>

                </div>

                <div>

                    @if($payment->status=='Paid')

                        <x-admin.badge
                            type="success"
                            text="Paid"/>

                    @elseif($payment->status=='Pending')

                        <x-admin.badge
                            type="warning"
                            text="Pending"/>

                    @else

                        <x-admin.badge
                            type="danger"
                            text="Failed"/>

                    @endif

                </div>

            </div>

        @empty

            <x-admin.empty-state
                icon="bi-cash-stack"
                title="No Payments"
                message="Recent payment records will appear here."/>

        @endforelse

    </x-admin.card>


    {{-- Latest Notices --}}
    <x-admin.card>

        <div class="flex items-center justify-between mb-5">

            <h2 class="text-base font-semibold flex items-center gap-2">

                <i class="bi bi-megaphone-fill text-orange-500"></i>

                Latest Notices

            </h2>

            <a
                href="{{ route('notices.index') }}"
                class="text-sm text-blue-600 hover:text-blue-700">

                View All

            </a>

        </div>

        @forelse($recentNotices as $notice)

            <div class="py-3 border-b border-slate-100 last:border-0">

                <p class="font-medium text-sm">

                    {{ $notice->title }}

                </p>

                <p class="text-xs text-slate-500 mt-1">

                    {{ \Illuminate\Support\Str::limit($notice->message,60) }}

                </p>

                <p class="text-xs text-slate-400 mt-2">

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


{{-- System Overview --}}

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    {{-- Occupancy Summary --}}
    <x-admin.card>

        <div class="flex items-center justify-between mb-6">

            <div>

                <h2 class="text-base font-semibold">

                    Occupancy Summary

                </h2>

                <p class="text-sm text-slate-500">

                    Current bed occupancy across all hostels

                </p>

            </div>

            <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center">

                <i class="bi bi-bar-chart-fill"></i>

            </div>

        </div>

        <div class="space-y-5">

            <div>

                <div class="flex justify-between text-sm mb-2">

                    <span class="text-slate-500">

                        Bed Occupancy

                    </span>

                    <span class="font-semibold">

                        {{ $occupancyRate }}%

                    </span>

                </div>

                <div class="w-full h-2 bg-slate-200 rounded-full overflow-hidden">

                    <div
                        class="h-full bg-blue-600 rounded-full"
                        style="width: {{ $occupancyRate }}%">
                    </div>

                </div>

            </div>

            <div class="grid grid-cols-3 gap-4 pt-2">

                <div class="text-center">

                    <p class="text-xs text-slate-500">

                        Occupied

                    </p>

                    <h3 class="text-xl font-bold text-blue-600">

                        {{ $occupiedBeds }}

                    </h3>

                </div>

                <div class="text-center">

                    <p class="text-xs text-slate-500">

                        Vacant

                    </p>

                    <h3 class="text-xl font-bold text-green-600">

                        {{ $vacantBeds }}

                    </h3>

                </div>

                <div class="text-center">

                    <p class="text-xs text-slate-500">

                        Capacity

                    </p>

                    <h3 class="text-xl font-bold text-slate-700">

                        {{ $totalBeds }}

                    </h3>

                </div>

            </div>

        </div>

    </x-admin.card>


    {{-- Financial Summary --}}
    <x-admin.card>

        <div class="flex items-center justify-between mb-6">

            <div>

                <h2 class="text-base font-semibold">

                    Financial Summary

                </h2>

                <p class="text-sm text-slate-500">

                    Revenue collected and outstanding balance

                </p>

            </div>

            <div class="w-10 h-10 rounded-xl bg-green-100 text-green-600 flex items-center justify-center">

                <i class="bi bi-cash-stack"></i>

            </div>

        </div>

        <div class="space-y-5">

            <div class="flex items-center justify-between border-b border-slate-200 pb-4">

                <div>

                    <p class="text-sm text-slate-500">

                        Total Revenue

                    </p>

                    <h3 class="text-2xl font-bold text-green-600 mt-1">

                        KSh {{ number_format($totalRevenue) }}

                    </h3>

                </div>

                <div class="w-12 h-12 rounded-xl bg-green-100 text-green-600 flex items-center justify-center">

                    <i class="bi bi-wallet2 text-lg"></i>

                </div>

            </div>

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-500">

                        Pending Payments

                    </p>

                    <h3 class="text-2xl font-bold text-orange-500 mt-1">

                        KSh {{ number_format($pendingPayments) }}

                    </h3>

                </div>

                <div class="w-12 h-12 rounded-xl bg-orange-100 text-orange-500 flex items-center justify-center">

                    <i class="bi bi-clock-history text-lg"></i>

                </div>

            </div>

        </div>

    </x-admin.card>

</div>

</div>

@endsection