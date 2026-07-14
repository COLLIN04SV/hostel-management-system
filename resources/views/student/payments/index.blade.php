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
    subtitle="Track your hostel fee payments, outstanding balance and payment history."/>

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

                <span class="font-bold">

                    KES {{ number_format($roomFee) }}

                </span>

            </div>

            <div class="flex justify-between">

                <span class="text-slate-500">

                    Amount Paid

                </span>

                <span class="font-bold text-green-600">

                    KES {{ number_format($totalPaid) }}

                </span>

            </div>

            <div class="flex justify-between">

                <span class="text-slate-500">

                    Outstanding Balance

                </span>

                <span class="font-bold text-red-600">

                    KES {{ number_format($balance) }}

                </span>

            </div>

            <div class="flex justify-between">

                <span class="text-slate-500">

                    Last Payment

                </span>

                <span class="font-semibold">

                    {{ $lastPaymentDate }}

                </span>

            </div>

            <div class="flex justify-between items-center">

                <span class="text-slate-500">

                    Account Status

                </span>

                @if($status=='Completed')

                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm">

                        Completed

                    </span>

                @elseif($status=='Partial')

                    <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-sm">

                        Partial

                    </span>

                @else

                    <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm">

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

        <div class="mb-4">

            <div class="flex justify-between mb-2">

                <span>

                    Progress

                </span>

                <span class="font-semibold">

                    {{ $progress }}%

                </span>

            </div>

            <div class="w-full h-3 bg-slate-200 rounded-full overflow-hidden">

                <div
                    class="h-full bg-green-600 rounded-full"
                    style="width: {{ $progress }}%">

                </div>

            </div>

        </div>

        <div class="grid grid-cols-3 gap-4 mt-6 text-center">

            <div>

                <p class="text-xs text-slate-500">

                    Fee

                </p>

                <h3 class="font-bold">

                    KES {{ number_format($roomFee) }}

                </h3>

            </div>

            <div>

                <p class="text-xs text-slate-500">

                    Paid

                </p>

                <h3 class="font-bold text-green-600">

                    KES {{ number_format($totalPaid) }}

                </h3>

            </div>

            <div>

                <p class="text-xs text-slate-500">

                    Balance

                </p>

                <h3 class="font-bold text-red-600">

                    KES {{ number_format($balance) }}

                </h3>

            </div>

        </div>

    </x-student.card>

</div>

{{-- Payment History --}}

<x-student.card>

<div class="flex items-center justify-between mb-6">

    <div>

        <h2 class="text-xl font-semibold">

            Payment History

        </h2>

        <p class="text-sm text-slate-500">

            All payments made towards your hostel fees

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
            href="{{ route('student.payments.receipt',$payment->id) }}"
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

        Once your hostel payments are recorded by the administration,
        they will appear here together with downloadable receipts.

    </p>

</div>

@endif

</x-student.card>

@endsection