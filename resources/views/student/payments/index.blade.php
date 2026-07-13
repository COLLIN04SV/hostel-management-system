@extends('student.layouts.app')

@section('title', 'Payments')

@section('student-content')

@php
    $lastPaymentDate = $lastPayment
        ? \Carbon\Carbon::parse($lastPayment->payment_date)->format('d M Y')
        : 'No Payments';
@endphp

<x-student.section-title
    title="Payments"
    subtitle="View your payment summary and payment history." />

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

    <x-student.stat-card
        title="Total Paid"
        :value="'KES ' . number_format($totalPaid)"
        icon="bi-cash-stack"
        color="green"/>

    <x-student.stat-card
        title="Payments Made"
        :value="$paymentCount"
        icon="bi-receipt"
        color="blue"/>

    <x-student.stat-card
        title="Last Payment"
        :value="$lastPaymentDate"
        icon="bi-calendar-check"
        color="indigo"/>

</div>

<x-student.card>

    <div class="flex items-center justify-between mb-6">

        <h2 class="text-xl font-semibold">
            Payment History
        </h2>

    </div>

    @if($payments->count())

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-gray-200">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-4 py-3 text-left">
                            Receipt
                        </th>

                        <th class="px-4 py-3 text-left">
                            Date
                        </th>

                        <th class="px-4 py-3 text-left">
                            Amount
                        </th>

                        <th class="px-4 py-3 text-left">
                            Method
                        </th>

                       <th class="px-4 py-3 text-left">
                          Status
                        </th>

                       <th class="px-4 py-3 text-center">
                          Receipt
                       </th>

                      

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-100 bg-white">

                    @foreach($payments as $payment)

                        <tr>

                            <td class="px-4 py-4">
                                #{{ $payment->id }}
                            </td>

                            <td class="px-4 py-4">
                                {{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y') }}
                            </td>

                            <td class="px-4 py-4 font-semibold">
                                KES {{ number_format($payment->amount) }}
                            </td>

                            <td class="px-4 py-4">
                                {{ $payment->payment_method }}
                            </td>

                            <td class="px-4 py-4">

                                @if($payment->status == 'Completed')

                                    <span class="px-3 py-1 rounded-full text-sm bg-green-100 text-green-700">
                                        Completed
                                    </span>

                                @elseif($payment->status == 'Pending')

                                    <span class="px-3 py-1 rounded-full text-sm bg-yellow-100 text-yellow-700">
                                        Pending
                                    </span>

                                @else

                                    <span class="px-3 py-1 rounded-full text-sm bg-red-100 text-red-700">
                                        Failed
                                    </span>

                                @endif

                            </td>

                            <td class="px-4 py-4 text-center">

    <a
        href="{{ route('student.payments.receipt', $payment->id) }}"
        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm">

        Download

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

        <div class="text-center py-16">

            <i class="bi bi-wallet2 text-5xl text-gray-300"></i>

            <h3 class="mt-4 text-xl font-semibold">
                No Payments Found
            </h3>

            <p class="mt-2 text-gray-500">
                Your payment history will appear here once payments are recorded.
            </p>

        </div>

    @endif

</x-student.card>

@endsection