@extends('layouts.admin')

@section('title','Payments')

@section('page-title','Payments')

@section('page-description','Manage student fee accounts')

@section('content')

<x-admin.page-header
    title="Student Payments"
    subtitle="Track room fees, balances and payment history">

    <x-admin.button
        href="{{ route('payments.create') }}">

        <i class="bi bi-plus-lg mr-2"></i>

        Record Payment

    </x-admin.button>

</x-admin.page-header>

<x-admin.stats-grid>

    <x-admin.stat-card
        title="Payment Records"
        :value="$totalPayments"
        icon="bi-credit-card"
        color="blue"/>

    <x-admin.stat-card
        title="Accounts Cleared"
        :value="$completedPayments"
        icon="bi-check-circle-fill"
        color="green"/>

    <x-admin.stat-card
        title="Outstanding Accounts"
        :value="$pendingPayments"
        icon="bi-clock-history"
        color="yellow"/>

    <x-admin.stat-card
        title="Revenue Collected"
        :value="'KSh '.number_format($totalCollected)"
        icon="bi-cash-stack"
        color="blue"/>

</x-admin.stats-grid>

<x-admin.table>

<x-admin.search-bar
    :action="route('payments.index')"
    placeholder="Search student..." />

<div class="flex items-center justify-between mb-5">

    <p class="text-sm text-slate-500">

        Showing

        <strong>{{ $accounts->firstItem() ?? 0 }}</strong>

        -

        <strong>{{ $accounts->lastItem() ?? 0 }}</strong>

        of

        <strong>{{ $accounts->total() }}</strong>

        student accounts

    </p>

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
Amount Paid
</x-admin.table-heading>

<x-admin.table-heading>
Balance
</x-admin.table-heading>

<x-admin.table-heading>
Last Payment
</x-admin.table-heading>

<x-admin.table-heading class="text-center">
Status
</x-admin.table-heading>

<x-admin.table-heading class="text-center">
Actions
</x-admin.table-heading>

</tr>

</thead>

<tbody>

@forelse($accounts as $account)

@php

$lastPayment = $account->payments()->latest()->first();

@endphp

<tr class="border-b border-slate-100 hover:bg-slate-50 transition">

<x-admin.table-cell>

    <div>

        <p class="font-medium text-slate-800">

            {{ $account->student->user->name }}

        </p>

        <p class="text-xs text-slate-500">

            {{ $account->student->registration_number }}

        </p>

    </div>

</x-admin.table-cell>


<x-admin.table-cell>

    <span class="font-semibold">

        KSh {{ number_format($account->room_fee) }}

    </span>

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

    @if($lastPayment)

        <div>

            <p class="font-medium">

                {{ \Carbon\Carbon::parse($lastPayment->payment_date)->format('d M Y') }}

            </p>

            <p class="text-xs text-slate-500">

                KSh {{ number_format($lastPayment->amount) }}

            </p>

        </div>

    @else

        <span class="text-slate-400">

            No payment yet

        </span>

    @endif

</x-admin.table-cell>


<x-admin.table-cell class="text-center">

    @if($account->status == 'Completed')

        <x-admin.badge
            type="success"
            text="Completed"/>

    @elseif($account->status == 'Partial')

        <x-admin.badge
            type="info"
            text="Partial"/>

    @else

        <x-admin.badge
            type="warning"
            text="Pending"/>

    @endif

</x-admin.table-cell>


<x-admin.table-cell class="text-center">

<div class="flex justify-center gap-2">

    @if($account->payments->count())

    @php
        $payment = $account->payments->last();
    @endphp

    <x-admin.action-button
        href="{{ route('payments.edit', $payment) }}"
        color="blue"
        icon="bi-pencil"
        title="Edit"/>

    <form
        method="POST"
        action="{{ route('payments.destroy', $payment) }}"
        onsubmit="return confirm('Delete this payment?')">

        @csrf
        @method('DELETE')

        <x-admin.action-button
            type="submit"
            color="red"
            icon="bi-trash"
            title="Delete"/>

    </form>

@endif

</div>

</x-admin.table-cell>

</tr>

@empty

<tr>

<td colspan="7">

<x-admin.empty-state
    icon="bi-credit-card"
    title="No Student Accounts"
    message="No student payment accounts have been created yet."/>

</td>

</tr>

@endforelse

</tbody>

</table>

<div class="mt-6 border-t border-slate-200 pt-4">

    {{ $accounts->links() }}

</div>

</x-admin.table>

@endsection