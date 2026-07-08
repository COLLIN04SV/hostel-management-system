@extends('student.layouts.app')

@section('title','My Payments')

@section('student-content')

<x-student.page-header
    title="My Payments"
    subtitle="Track your hostel fee payments"/>

<div class="grid md:grid-cols-3 gap-6 mb-8">

    <x-student.stat-card
        title="Total Paid"
        :value="'KES '.number_format($totalPaid)"
        icon="bi-credit-card"
        color="green"/>

    <x-student.stat-card
        title="Pending"
        :value="'KES '.number_format($pendingAmount)"
        icon="bi-hourglass-split"
        color="yellow"/>

    <x-student.stat-card
        title="Payment Records"
        :value="$totalPayments"
        icon="bi-receipt"
        color="indigo"/>

</div>

<x-student.card>

@if($payments->isEmpty())

<div class="text-center py-16">

    <i class="bi bi-receipt text-6xl text-gray-300"></i>

    <h3 class="text-xl font-semibold mt-4">
        No Payments Found
    </h3>

    <p class="text-gray-500">
        Your payment records will appear here.
    </p>

</div>

@else

<x-student.table>

<thead>

<tr class="bg-gray-50 border-b">

    <th class="px-5 py-4 text-left">Amount</th>
    <th class="px-5 py-4 text-left">Payment Date</th>
    <th class="px-5 py-4 text-center">Status</th>

</tr>

</thead>

<tbody>

@foreach($payments as $payment)

<tr class="border-b hover:bg-gray-50">

    <td class="px-5 py-4">
        KES {{ number_format($payment->amount) }}
    </td>

    <td class="px-5 py-4">
        {{ \Carbon\Carbon::parse($payment->created_at)->format('d M Y') }}
    </td>

    <td class="px-5 py-4 text-center">

        @if($payment->status=='Paid')

            <x-student.badge
                type="green"
                text="Paid"/>

        @else

            <x-student.badge
                type="yellow"
                text="Pending"/>

        @endif

    </td>

</tr>

@endforeach

</tbody>

</x-student.table>

@endif

</x-student.card>

@endsection