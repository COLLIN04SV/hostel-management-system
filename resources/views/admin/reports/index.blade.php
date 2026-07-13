@extends('layouts.admin')

@section('page-title','Reports')

@section('content')

<x-admin.page-header
    title="Reports Dashboard"
    subtitle="Hostel performance, financial reports and occupancy statistics"/>

{{-- Main Statistics --}}

<x-admin.stats-grid>

    <x-admin.stat-card
        title="Students"
        :value="$totalStudents"
        icon="bi-people-fill"
        color="blue"/>

    <x-admin.stat-card
        title="Revenue Collected"
        :value="'KSh '.number_format($totalRevenue)"
        icon="bi-cash-stack"
        color="green"/>

    <x-admin.stat-card
        title="Outstanding Balance"
        :value="'KSh '.number_format($outstandingBalance)"
        icon="bi-wallet2"
        color="yellow"/>

    <x-admin.stat-card
        title="Occupancy"
        :value="$occupancyRate.'%'"
        icon="bi-house-check-fill"
        color="indigo"/>

</x-admin.stats-grid>



{{-- Payment Statistics --}}

<x-admin.stats-grid>

    <x-admin.stat-card
        title="Accounts Cleared"
        :value="$completedAccounts"
        icon="bi-check-circle-fill"
        color="green"/>

    <x-admin.stat-card
        title="Partial Payments"
        :value="$partialAccounts"
        icon="bi-hourglass-split"
        color="blue"/>

    <x-admin.stat-card
        title="Pending Payments"
        :value="$pendingAccounts"
        icon="bi-clock-history"
        color="yellow"/>

    <x-admin.stat-card
        title="Allocated Students"
        :value="$allocatedStudents"
        icon="bi-person-check-fill"
        color="blue"/>

</x-admin.stats-grid>



<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

{{-- Occupancy Summary --}}

<x-admin.card>

    <div class="flex items-center justify-between mb-5">

        <div>

            <h2 class="text-lg font-semibold">

                Hostel Occupancy

            </h2>

            <p class="text-sm text-slate-500">

                Overall bed utilization

            </p>

        </div>

        <i class="bi bi-building text-2xl text-blue-600"></i>

    </div>

    <div class="space-y-5">

        <div>

            <div class="flex justify-between text-sm mb-2">

                <span>Occupancy Rate</span>

                <span class="font-semibold">

                    {{ $occupancyRate }}%

                </span>

            </div>

            <div class="w-full h-3 bg-slate-200 rounded-full overflow-hidden">

                <div
                    class="h-full bg-blue-600 rounded-full"
                    style="width: {{ $occupancyRate }}%">
                </div>

            </div>

        </div>

        <div class="grid grid-cols-3 gap-4 text-center">

            <div>

                <p class="text-xs text-slate-500">

                    Capacity

                </p>

                <h3 class="text-xl font-bold">

                    {{ $totalBeds }}

                </h3>

            </div>

            <div>

                <p class="text-xs text-slate-500">

                    Occupied

                </p>

                <h3 class="text-xl font-bold text-blue-600">

                    {{ $occupiedBeds }}

                </h3>

            </div>

            <div>

                <p class="text-xs text-slate-500">

                    Vacant

                </p>

                <h3 class="text-xl font-bold text-green-600">

                    {{ $vacantBeds }}

                </h3>

            </div>

        </div>

    </div>

</x-admin.card>

{{-- Financial Summary --}}

<x-admin.card>

    <div class="flex items-center justify-between mb-5">

        <div>

            <h2 class="text-lg font-semibold">

                Financial Summary

            </h2>

            <p class="text-sm text-slate-500">

                Student payment progress

            </p>

        </div>

        <i class="bi bi-cash-stack text-2xl text-green-600"></i>

    </div>

    <div class="space-y-5">

        <div class="flex justify-between items-center">

            <span class="text-slate-500">

                Revenue Collected

            </span>

            <span class="text-xl font-bold text-green-600">

                KSh {{ number_format($totalRevenue) }}

            </span>

        </div>

        <div class="flex justify-between items-center">

            <span class="text-slate-500">

                Outstanding Balance

            </span>

            <span class="text-xl font-bold text-red-600">

                KSh {{ number_format($outstandingBalance) }}

            </span>

        </div>

        <div class="grid grid-cols-3 gap-4 pt-4">

            <div class="text-center">

                <p class="text-xs text-slate-500">

                    Paid

                </p>

                <h3 class="text-xl font-bold text-green-600">

                    {{ $completedAccounts }}

                </h3>

            </div>

            <div class="text-center">

                <p class="text-xs text-slate-500">

                    Partial

                </p>

                <h3 class="text-xl font-bold text-blue-600">

                    {{ $partialAccounts }}

                </h3>

            </div>

            <div class="text-center">

                <p class="text-xs text-slate-500">

                    Pending

                </p>

                <h3 class="text-xl font-bold text-yellow-600">

                    {{ $pendingAccounts }}

                </h3>

            </div>

        </div>

    </div>

</x-admin.card>

</div>



{{-- Student Payment Report --}}

<x-admin.table>

<div class="flex items-center justify-between mb-5">

    <h2 class="text-lg font-semibold">

        Student Payment Report

    </h2>

</div>

<table class="min-w-full">

<thead class="bg-slate-50 border-b">

<tr>

<x-admin.table-heading>

Student

</x-admin.table-heading>

<x-admin.table-heading>

Room Fee

</x-admin.table-heading>

<x-admin.table-heading>

Paid

</x-admin.table-heading>

<x-admin.table-heading>

Balance

</x-admin.table-heading>

<x-admin.table-heading>

Status

</x-admin.table-heading>

</tr>

</thead>

<tbody>

@forelse($studentAccounts as $account)

<tr class="border-b border-slate-100 hover:bg-slate-50">

<x-admin.table-cell>

<div>

<p class="font-medium">

{{ $account->student->user->name }}

</p>

<p class="text-xs text-slate-500">

{{ $account->student->registration_number }}

</p>

</div>

</x-admin.table-cell>

<x-admin.table-cell>

KSh {{ number_format($account->room_fee) }}

</x-admin.table-cell>

<x-admin.table-cell>

<span class="font-semibold text-green-600">

KSh {{ number_format($account->amount_paid) }}

</span>

</x-admin.table-cell>

<x-admin.table-cell>

@if($account->balance > 0)

<span class="font-semibold text-red-600">

KSh {{ number_format($account->balance) }}

</span>

@else

<span class="font-semibold text-green-600">

Cleared

</span>

@endif

</x-admin.table-cell>

<x-admin.table-cell>

@if($account->status=='Completed')

<x-admin.badge
type="success"
text="Completed"/>

@elseif($account->status=='Partial')

<x-admin.badge
type="info"
text="Partial"/>

@else

<x-admin.badge
type="warning"
text="Pending"/>

@endif

</x-admin.table-cell>

</tr>

@empty

<tr>

<td colspan="5">

<x-admin.empty-state
icon="bi-wallet2"
title="No Student Accounts"
message="Student accounts will appear here."/>

</td>

</tr>

@endforelse

</tbody>

</table>

</x-admin.table>

{{-- Hostel Occupancy Report --}}

<x-admin.table>

<div class="flex items-center justify-between mb-5">

    <h2 class="text-lg font-semibold">

        Hostel Occupancy Report

    </h2>

</div>


<table class="min-w-full">

<thead class="bg-slate-50 border-b">

<tr>

<x-admin.table-heading>

Hostel

</x-admin.table-heading>


<x-admin.table-heading>

Capacity

</x-admin.table-heading>


<x-admin.table-heading>

Occupied

</x-admin.table-heading>


<x-admin.table-heading>

Available

</x-admin.table-heading>


<x-admin.table-heading>

Occupancy

</x-admin.table-heading>

</tr>

</thead>


<tbody>

@forelse($hostels as $hostel)

@php

    $capacity = $hostel->rooms->sum('capacity');

    $occupied = $hostel->rooms->sum('occupied');

    $available = $capacity - $occupied;

    $rate = $capacity > 0
        ? round(($occupied / $capacity) * 100)
        : 0;

@endphp


<tr class="border-b border-slate-100 hover:bg-slate-50">


<x-admin.table-cell>

{{ $hostel->name }}

</x-admin.table-cell>


<x-admin.table-cell>

{{ $capacity }}

</x-admin.table-cell>


<x-admin.table-cell>

<span class="font-semibold text-blue-600">

{{ $occupied }}

</span>

</x-admin.table-cell>


<x-admin.table-cell>

<span class="font-semibold text-green-600">

{{ $available }}

</span>

</x-admin.table-cell>


<x-admin.table-cell>

<div class="flex items-center gap-3">

<span>

{{ $rate }}%

</span>


<div class="w-24 h-2 bg-slate-200 rounded-full overflow-hidden">

<div
class="h-full bg-blue-600"
style="width: {{ $rate }}%">
</div>

</div>

</div>

</x-admin.table-cell>


</tr>


@empty

<tr>

<td colspan="5">

<x-admin.empty-state
icon="bi-building"
title="No Hostels"
message="Hostel occupancy data will appear here."/>

</td>

</tr>

@endforelse


</tbody>

</table>


</x-admin.table>



{{-- Recent Allocations --}}


<x-admin.table>


<div class="flex items-center justify-between mb-5">

<h2 class="text-lg font-semibold">

Recent Allocations

</h2>

</div>


<table class="min-w-full">


<thead class="bg-slate-50 border-b">

<tr>


<x-admin.table-heading>

Student

</x-admin.table-heading>


<x-admin.table-heading>

Hostel

</x-admin.table-heading>


<x-admin.table-heading>

Room

</x-admin.table-heading>


<x-admin.table-heading>

Date

</x-admin.table-heading>


<x-admin.table-heading>

Status

</x-admin.table-heading>


</tr>

</thead>



<tbody>


@forelse($recentAllocations as $allocation)


<tr class="border-b border-slate-100 hover:bg-slate-50">


<x-admin.table-cell>

<div>

<p class="font-medium">

{{ $allocation->student->user->name }}

</p>

<p class="text-xs text-slate-500">

{{ $allocation->student->registration_number }}

</p>

</div>

</x-admin.table-cell>



<x-admin.table-cell>

{{ $allocation->room->hostel->name }}

</x-admin.table-cell>



<x-admin.table-cell>

{{ $allocation->room->room_number }}

</x-admin.table-cell>



<x-admin.table-cell>

{{ \Carbon\Carbon::parse($allocation->allocated_date)->format('d M Y') }}

</x-admin.table-cell>



<x-admin.table-cell>


@if($allocation->status == 'Active')

<x-admin.badge
type="success"
text="Active"/>


@else

<x-admin.badge
type="danger"
text="Vacated"/>


@endif


</x-admin.table-cell>



</tr>



@empty


<tr>

<td colspan="5">


<x-admin.empty-state

icon="bi-house-check"

title="No Allocations"

message="Room allocation records will appear here."

/>


</td>


</tr>


@endforelse



</tbody>


</table>


</x-admin.table>




{{-- Recent Payments --}}


<x-admin.table>


<div class="flex items-center justify-between mb-5">


<h2 class="text-lg font-semibold">

Recent Payments

</h2>


</div>


<table class="min-w-full">


<thead class="bg-slate-50 border-b">


<tr>


<x-admin.table-heading>

Student

</x-admin.table-heading>


<x-admin.table-heading>

Amount

</x-admin.table-heading>


<x-admin.table-heading>

Method

</x-admin.table-heading>


<x-admin.table-heading>

Date

</x-admin.table-heading>



</tr>


</thead>



<tbody>


@forelse($recentPayments as $payment)



<tr class="border-b border-slate-100 hover:bg-slate-50">



<x-admin.table-cell>


{{ $payment->student->user->name ?? 'Unknown' }}


</x-admin.table-cell>




<x-admin.table-cell>


<span class="font-semibold text-green-600">

KSh {{ number_format($payment->amount) }}

</span>


</x-admin.table-cell>




<x-admin.table-cell>


{{ $payment->payment_method }}


</x-admin.table-cell>




<x-admin.table-cell>


{{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y') }}


</x-admin.table-cell>



</tr>



@empty


<tr>

<td colspan="4">


<x-admin.empty-state

icon="bi-credit-card"

title="No Payments"

message="Recent payments will appear here."

/>


</td>


</tr>


@endforelse



</tbody>


</table>


</x-admin.table>



@endsection