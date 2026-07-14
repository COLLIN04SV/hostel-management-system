@extends('student.layouts.app')

@section('title','Receipts')

@section('student-content')

<x-student.section-title
    title="Payment Receipts"
    subtitle="Download and keep copies of all hostel payment receipts."/>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

    <x-student.stat-card
        title="Receipts"
        :value="$payments->count()"
        icon="bi-receipt-cutoff"
        color="blue"/>

    <x-student.stat-card
        title="Total Paid"
        :value="'KES '.number_format($payments->sum('amount'))"
        icon="bi-cash-stack"
        color="green"/>

    <x-student.stat-card
        title="Latest Receipt"
        :value="$payments->first()
            ? '#'.str_pad($payments->first()->id,6,'0',STR_PAD_LEFT)
            : 'None'"
        icon="bi-file-earmark-pdf"
        color="indigo"/>

</div>

<x-student.card>

<div class="flex items-center justify-between mb-6">

    <h2 class="text-xl font-semibold">

        Receipt History

    </h2>

</div>

@if($payments->count())

<div class="overflow-x-auto">

<table class="min-w-full divide-y divide-gray-200">

<thead class="bg-gray-50">

<tr>

<th class="px-4 py-3 text-left">

Receipt No.

</th>

<th class="px-4 py-3 text-left">

Payment Date

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

Download

</th>

</tr>

</thead>

<tbody class="divide-y divide-gray-100 bg-white">

@foreach($payments as $payment)

<tr>

<td class="px-4 py-4 font-semibold text-indigo-600">

#{{ str_pad($payment->id,6,'0',STR_PAD_LEFT) }}

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

@if($payment->status=='Completed')

<span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm">

Completed

</span>

@elseif($payment->status=='Pending')

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
href="{{ route('student.receipts.download',$payment->id) }}"
class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition">

<i class="bi bi-download"></i>

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

<div class="py-16 text-center">

<i class="bi bi-file-earmark-pdf text-6xl text-gray-300"></i>

<h3 class="mt-5 text-xl font-semibold">

No Receipts Available

</h3>

<p class="mt-2 text-gray-500">

Your payment receipts will appear here after your payments have been recorded.

</p>

</div>

@endif

</x-student.card>

@endsection