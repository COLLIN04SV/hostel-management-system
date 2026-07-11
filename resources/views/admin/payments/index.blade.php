@extends('layouts.admin')

@section('title','Payments')

@section('page-title','Payments')

@section('page-description','Manage hostel payment records')

@section('content')

<x-admin.page-header
    title="Payments"
    subtitle="Manage hostel payment records">

    <x-admin.button
        href="{{ route('payments.create') }}">

        <i class="bi bi-plus-lg mr-2"></i>

        Record Payment

    </x-admin.button>

</x-admin.page-header>

<x-admin.stats-grid>

    <x-admin.stat-card
        title="Total Payments"
        :value="$totalPayments"
        icon="bi-credit-card"
        color="blue"/>

    <x-admin.stat-card
        title="Completed"
        :value="$completedPayments"
        icon="bi-check-circle"
        color="green"/>

    <x-admin.stat-card
        title="Pending"
        :value="$pendingPayments"
        icon="bi-clock-history"
        color="yellow"/>

    <x-admin.stat-card
        title="Revenue"
        :value="'KSh '.number_format($totalCollected)"
        icon="bi-cash-stack"
        color="blue"/>

</x-admin.stats-grid>

<x-admin.table>

<x-admin.search-bar
    :action="route('payments.index')"
    placeholder="Search student, reference or payment method..." />

<div class="flex items-center justify-between mb-5">

    <p class="text-sm text-slate-500">

        Showing

        <strong>{{ $payments->firstItem() ?? 0 }}</strong>

        -

        <strong>{{ $payments->lastItem() ?? 0 }}</strong>

        of

        <strong>{{ $payments->total() }}</strong>

        payments

    </p>

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

Reference

</x-admin.table-heading>

<x-admin.table-heading>

Date

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

@forelse($payments as $payment)

<tr class="border-b border-slate-100 hover:bg-slate-50 transition">

<x-admin.table-cell>

<div>

<p class="font-medium text-slate-800">

{{ $payment->student->user->name ?? 'Unknown Student' }}

</p>

<p class="text-xs text-slate-500">

{{ $payment->student->registration_number ?? '' }}

</p>

</div>

</x-admin.table-cell>

<x-admin.table-cell class="font-medium">

KSh {{ number_format($payment->amount) }}

</x-admin.table-cell>

<x-admin.table-cell>

{{ $payment->payment_method }}

</x-admin.table-cell>

<x-admin.table-cell>

{{ $payment->transaction_reference }}

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
        text="{{ $payment->status }}"/>

@endif

</x-admin.table-cell>

<x-admin.table-cell class="text-center">

<div class="flex items-center justify-center gap-2">

<x-admin.action-button
    href="{{ route('payments.edit',$payment) }}"
    color="blue"
    icon="bi-pencil"
    title="Edit"/>

<form
    method="POST"
    action="{{ route('payments.destroy',$payment) }}"
    onsubmit="return confirm('Delete this payment?')">

    @csrf
    @method('DELETE')

    <x-admin.action-button
        type="submit"
        color="red"
        icon="bi-trash"
        title="Delete"/>

</form>

</div>

</x-admin.table-cell>

</tr>

@empty

<tr>

<td colspan="7">

<x-admin.empty-state
    icon="bi-credit-card"
    title="No Payments Found"
    message="No payment records are available."/>

</td>

</tr>

@endforelse

</tbody>

</table>

<div class="mt-5 border-t border-slate-200 pt-4">

    {{ $payments->links() }}

</div>

</x-admin.table>

@endsection