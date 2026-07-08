@extends('student.layouts.app')

@section('title','Receipts')

@section('student-content')

<x-student.page-header
    title="Payment Receipts"
    subtitle="View all successful hostel payments"/>

<x-student.card>

@if($payments->isEmpty())

<div class="text-center py-16">

    <i class="bi bi-receipt text-6xl text-gray-300"></i>

    <h3 class="text-xl font-semibold mt-4">

        No Receipts Available

    </h3>

    <p class="text-gray-500">

        Receipts will appear after successful payments.

    </p>

</div>

@else

<x-student.table>

<thead>

<tr class="bg-gray-50 border-b">

    <th class="px-5 py-4 text-left">
        Receipt No
    </th>

    <th class="px-5 py-4 text-left">
        Amount
    </th>

    <th class="px-5 py-4 text-left">
        Date
    </th>

    <th class="px-5 py-4 text-center">
        Action
    </th>

</tr>

</thead>

<tbody>

@foreach($payments as $payment)

<tr class="border-b hover:bg-gray-50">

    <td class="px-5 py-4">

        RCPT-{{ str_pad($payment->id,5,'0',STR_PAD_LEFT) }}

    </td>

    <td class="px-5 py-4">

        KES {{ number_format($payment->amount) }}

    </td>

    <td class="px-5 py-4">

        {{ $payment->created_at->format('d M Y') }}

    </td>

    <td class="px-5 py-4 text-center">

        <button
            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg">

            <i class="bi bi-download mr-1"></i>

            Download

        </button>

    </td>

</tr>

@endforeach

</tbody>

</x-student.table>

@endif

</x-student.card>

@endsection