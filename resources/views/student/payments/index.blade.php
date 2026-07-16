@extends('student.layouts.app')

@section('title', 'My Payments')

@section('student-content')

@php

$lastPaymentDate = $lastPayment
    ? \Carbon\Carbon::parse($lastPayment->payment_date)->format('d M Y')
    : 'No Payments';

$account = auth()->user()->student->account;

$roomFee = $account?->room_fee ?? 0;

$balance = $account?->balance ?? 0;

$status = $account?->status ?? 'Pending';

$progress = $roomFee > 0
    ? round((($roomFee - $balance) / $roomFee) * 100)
    : 0;

@endphp

<x-student.section-title
    title="Payments"
    subtitle="Track your hostel fee payments and make secure online payments."/>

@if(session('success'))

<div class="mb-6 rounded-xl bg-green-100 border border-green-300 text-green-800 px-5 py-4">

    {{ session('success') }}

</div>

@endif

@if($errors->any())

<div class="mb-6 rounded-xl bg-red-100 border border-red-300 text-red-700 px-5 py-4">

    {{ $errors->first() }}

</div>

@endif

{{-- Statistics --}}

<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

<x-student.stat-card
    title="Room Fee"
    :value="'KES '.number_format($roomFee)"
    icon="bi-house-door-fill"
    color="indigo"/>

<x-student.stat-card
    title="Total Paid"
    :value="'KES '.number_format($totalPaid)"
    icon="bi-cash-stack"
    color="green"/>

<x-student.stat-card
    title="Outstanding"
    :value="'KES '.number_format($balance)"
    icon="bi-wallet2"
    color="yellow"/>

<x-student.stat-card
    title="Payments Made"
    :value="$paymentCount"
    icon="bi-receipt"
    color="blue"/>

</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

{{-- Account Summary --}}

<x-student.card>

<div class="flex items-center justify-between mb-6">

<div>

<h2 class="text-lg font-semibold">

Account Summary

</h2>

<p class="text-sm text-slate-500">

Current financial status

</p>

</div>

<i class="bi bi-wallet2 text-3xl text-indigo-600"></i>

</div>

<div class="space-y-5">

<div class="flex justify-between">

<span class="text-slate-500">

Hostel Fee

</span>

<strong>

KES {{ number_format($roomFee) }}

</strong>

</div>

<div class="flex justify-between">

<span class="text-slate-500">

Amount Paid

</span>

<strong class="text-green-600">

KES {{ number_format($totalPaid) }}

</strong>

</div>

<div class="flex justify-between">

<span class="text-slate-500">

Outstanding Balance

</span>

<strong class="text-red-600">

KES {{ number_format($balance) }}

</strong>

</div>

<div class="flex justify-between">

<span>

Last Payment

</span>

<strong>

{{ $lastPaymentDate }}

</strong>

</div>

<div class="flex justify-between">

<span>

Status

</span>

@if($status=='Completed')

<span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">

Completed

</span>

@elseif($status=='Partial')

<span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full">

Partial

</span>

@else

<span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">

Pending

</span>

@endif

</div>

</div>

</x-student.card>

{{-- Payment Progress --}}

<x-student.card>

<div class="flex items-center justify-between mb-6">

<div>

<h2 class="text-lg font-semibold">

Payment Progress

</h2>

<p class="text-sm text-slate-500">

Overall completion

</p>

</div>

<i class="bi bi-graph-up-arrow text-3xl text-green-600"></i>

</div>

<div class="mb-5">

<div class="flex justify-between mb-2">

<span>

Progress

</span>

<strong>

{{ $progress }}%

</strong>

</div>

<div class="w-full h-3 bg-slate-200 rounded-full">

<div
class="bg-green-600 h-3 rounded-full"
style="width: {{ $progress }}%">

</div>

</div>

</div>

<div class="grid grid-cols-3 gap-5 text-center">

<div>

<p class="text-xs text-slate-500">

Fee

</p>

<strong>

KES {{ number_format($roomFee) }}

</strong>

</div>

<div>

<p class="text-xs text-slate-500">

Paid

</p>

<strong class="text-green-600">

KES {{ number_format($totalPaid) }}

</strong>

</div>

<div>

<p class="text-xs text-slate-500">

Balance

</p>

<strong class="text-red-600">

KES {{ number_format($balance) }}

</strong>

</div>

</div>

</x-student.card>

</div>

{{-- ========================= --}}
{{-- SIMULATED PAYMENT GATEWAY --}}
{{-- ========================= --}}

@if($balance > 0)

<x-student.card>

<div class="flex items-center justify-between mb-6">

<div>

<h2 class="text-xl font-semibold">

Make Payment

</h2>

<p class="text-slate-500">

Simulated payment gateway

</p>

</div>

<i class="bi bi-credit-card text-4xl text-indigo-600"></i>

</div>

<form
method="POST"
action="{{ route('student.payments.pay') }}">

@csrf

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

<div>

<label class="block mb-2 font-medium">

Amount (KES)

</label>

<input
type="number"
name="amount"
min="1"
max="{{ $balance }}"
value="{{ $balance }}"
class="w-full rounded-lg border px-4 py-3"
required>

</div>

<div>

<label class="block mb-2 font-medium">

Payment Method

</label>

<select
name="payment_method"
class="w-full rounded-lg border px-4 py-3">

<option value="M-Pesa">

M-Pesa

</option>

<option value="Visa Card">

Visa Card

</option>

<option value="MasterCard">

MasterCard

</option>

<option value="Bank Transfer">

Bank Transfer

</option>

</select>

</div>

</div>

<div class="mt-6">

<button
class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-xl">

<i class="bi bi-credit-card mr-2"></i>

Simulate Payment

</button>

</div>

</form>

</x-student.card>

@endif

{{-- Payment History --}}

<x-student.card>

<div class="flex items-center justify-between mb-6">

    <div>

        <h2 class="text-xl font-semibold">

            Payment History

        </h2>

        <p class="text-sm text-slate-500">

            Every simulated payment automatically generates a receipt.

        </p>

    </div>

</div>

@if($payments->count())

<div class="overflow-x-auto">

<table class="min-w-full divide-y divide-slate-200">

<thead class="bg-slate-50">

<tr>

<th class="px-4 py-3 text-left text-sm font-semibold">

Receipt #

</th>

<th class="px-4 py-3 text-left text-sm font-semibold">

Reference

</th>

<th class="px-4 py-3 text-left text-sm font-semibold">

Date

</th>

<th class="px-4 py-3 text-left text-sm font-semibold">

Amount

</th>

<th class="px-4 py-3 text-left text-sm font-semibold">

Method

</th>

<th class="px-4 py-3 text-left text-sm font-semibold">

Status

</th>

<th class="px-4 py-3 text-center text-sm font-semibold">

Receipt

</th>

</tr>

</thead>

<tbody class="divide-y divide-slate-100 bg-white">

@foreach($payments as $payment)

<tr class="hover:bg-slate-50 transition">

    <td class="px-4 py-4">

        <span class="font-semibold">

            #{{ $payment->id }}

        </span>

    </td>

    <td class="px-4 py-4">

        <span class="font-mono text-sm">

            {{ $payment->transaction_reference }}

        </span>

    </td>

    <td class="px-4 py-4">

        {{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y') }}

    </td>

    <td class="px-4 py-4">

        <span class="font-semibold text-green-600">

            KES {{ number_format($payment->amount) }}

        </span>

    </td>

    <td class="px-4 py-4">

        {{ $payment->payment_method }}

    </td>

    <td class="px-4 py-4">

        @if($payment->status == 'Completed')

            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm">

                Completed

            </span>

        @elseif($payment->status == 'Pending')

            <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm">

                Pending

            </span>

        @else

            <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm">

                Failed

            </span>

        @endif

    </td>

    <td class="px-4 py-4 text-center">

        <a
            href="{{ route('student.payments.receipt', $payment->id) }}"
            class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition">

            <i class="bi bi-download"></i>

            Receipt

        </a>

    </td>

</tr>

@endforeach

</tbody>

</table>

</div>

<div class="mt-6">

    {{ $payments->links() }}

</div>

@else

<div class="py-16 text-center">

    <div class="w-20 h-20 mx-auto rounded-full bg-slate-100 flex items-center justify-center mb-5">

        <i class="bi bi-wallet2 text-4xl text-slate-400"></i>

    </div>

    <h3 class="text-xl font-semibold text-slate-700">

        No Payments Yet

    </h3>

    <p class="text-slate-500 mt-2">

        You have not made any hostel payments yet.

    </p>

</div>

@endif

</x-student.card>

@endsection