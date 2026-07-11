@extends('layouts.admin')

@section('page-title','Reports')

@section('content')

<x-admin.page-header
    title="Reports Dashboard"
    subtitle="System statistics and performance overview"/>

{{-- Top Statistics --}}

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
        icon="bi-door-open"
        color="yellow"/>

    <x-admin.stat-card
        title="Revenue"
        :value="'KSh '.number_format($totalCollected)"
        icon="bi-cash-stack"
        color="green"/>

</x-admin.stats-grid>

<x-admin.stats-grid>

    <x-admin.stat-card
        title="Allocated Students"
        :value="$allocatedStudents"
        icon="bi-house-check"
        color="green"/>

    <x-admin.stat-card
        title="Unallocated"
        :value="$unallocatedStudents"
        icon="bi-person-x"
        color="red"/>

    <x-admin.stat-card
        title="Applications"
        :value="$totalApplications"
        icon="bi-file-earmark-text"
        color="blue"/>

    <x-admin.stat-card
        title="Payments"
        :value="$totalPayments"
        icon="bi-credit-card"
        color="yellow"/>

</x-admin.stats-grid>

<div class="grid lg:grid-cols-2 gap-5 mb-6">

<x-admin.card>

    <h3 class="text-base font-semibold text-slate-800 mb-4">

        Room Summary

    </h3>

    <div class="space-y-3 text-sm">

        <div class="flex justify-between">

            <span class="text-slate-500">

                Total Rooms

            </span>

            <span class="font-semibold">

                {{ $totalRooms }}

            </span>

        </div>

        <div class="flex justify-between">

            <span class="text-slate-500">

                Occupied Rooms

            </span>

            <span class="font-semibold">

                {{ $occupiedRooms }}

            </span>

        </div>

        <div class="flex justify-between">

            <span class="text-slate-500">

                Vacant Rooms

            </span>

            <span class="font-semibold">

                {{ $vacantRooms }}

            </span>

        </div>

    </div>

</x-admin.card>

<x-admin.card>

    <h3 class="text-base font-semibold text-slate-800 mb-4">

        Application Summary

    </h3>

    <div class="space-y-3 text-sm">

        <div class="flex justify-between items-center">

            <span class="text-slate-500">

                Total Applications

            </span>

            <span class="font-semibold">

                {{ $totalApplications }}

            </span>

        </div>

        <div class="flex justify-between items-center">

            <span class="text-slate-500">

                Pending

            </span>

            <x-admin.badge
                type="warning"
                text="{{ $pendingApplications }}"/>

        </div>

        <div class="flex justify-between items-center">

            <span class="text-slate-500">

                Approved

            </span>

            <x-admin.badge
                type="success"
                text="{{ $approvedApplications }}"/>

        </div>

    </div>

</x-admin.card>

</div>

<x-admin.table>

<div class="flex items-center justify-between mb-5">

    <h3 class="text-base font-semibold text-slate-800">

        Recent Payments

    </h3>

</div>

<table class="w-full">

<thead class="bg-slate-50">

<tr>

    <x-admin.table-heading text-left>

        Student

    </x-admin.table-heading>

    <x-admin.table-heading text-left>

        Amount

    </x-admin.table-heading>

    <x-admin.table-heading text-left>

        Date

    </x-admin.table-heading>

    <x-admin.table-heading text-center>

        Status

    </x-admin.table-heading>

</tr>

</thead>

<tbody>

@forelse($recentPayments as $payment)

<tr class="border-b border-slate-100 hover:bg-slate-50 transition">

    <x-admin.table-cell>

        <div>

            <p class="font-medium text-slate-800">

                {{ $payment->student->user->name }}

            </p>

            <p class="text-xs text-slate-500">

                {{ $payment->student->registration_number ?? '' }}

            </p>

        </div>

    </x-admin.table-cell>

    <x-admin.table-cell>

        <span class="font-semibold">

            KSh {{ number_format($payment->amount) }}

        </span>

    </x-admin.table-cell>

    <x-admin.table-cell>

        {{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y') }}

    </x-admin.table-cell>

    <x-admin.table-cell class="text-center">

        @if($payment->status == 'Completed')

            <x-admin.badge
                type="success"
                text="Completed"/>

        @elseif($payment->status == 'Pending')

            <x-admin.badge
                type="warning"
                text="Pending"/>

        @else

            <x-admin.badge
                type="danger"
                :text="$payment->status"/>

        @endif

    </x-admin.table-cell>

</tr>

@empty

<tr>

    <td colspan="4">

        <x-admin.empty-state
            icon="bi-credit-card"
            title="No Payments Found"
            message="No payment records are available."/>

    </td>

</tr>

@endforelse

</tbody>

</table>

</x-admin.table>

@endsection