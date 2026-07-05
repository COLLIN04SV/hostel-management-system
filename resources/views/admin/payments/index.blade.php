@extends('layouts.admin')

@section('page-title', 'Payments')

@section('content')

<x-admin.page-header
    title="Payments"
    subtitle="Manage hostel payment records">

    <a href="{{ route('payments.create') }}">
        <x-admin.button color="blue">
            <i class="bi bi-plus-lg mr-2"></i>
            Record Payment
        </x-admin.button>
    </a>

</x-admin.page-header>

@if(session('success'))

<div class="mb-6 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl">

    {{ session('success') }}

</div>

@endif

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

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

</div>

<x-admin.card>

<div class="overflow-x-auto">

<table class="w-full">

<thead>

<tr class="border-b bg-gray-50">

<th class="px-6 py-4 text-left">Student</th>

<th class="px-6 py-4 text-left">Amount</th>

<th class="px-6 py-4 text-left">Method</th>

<th class="px-6 py-4 text-left">Reference</th>

<th class="px-6 py-4 text-left">Date</th>

<th class="px-6 py-4 text-center">Status</th>

<th class="px-6 py-4 text-center">Actions</th>

</tr>

</thead>

<tbody>

@forelse($payments as $payment)

<tr class="border-b hover:bg-gray-50">

<td class="px-6 py-4">

    <div class="font-semibold">

        {{ $payment->student->user->name ?? 'Unknown Student' }}

    </div>

    <div class="text-sm text-gray-500">

        {{ $payment->student->registration_number ?? '' }}

    </div>

</td>

<td class="px-6 py-4 font-semibold">

    KSh {{ number_format($payment->amount) }}

</td>

<td class="px-6 py-4">

    {{ $payment->payment_method }}

</td>

<td class="px-6 py-4">

    {{ $payment->transaction_reference }}

</td>

<td class="px-6 py-4">

    {{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y') }}

</td>

<td>

@if($payment->status=='Completed')

    <x-admin.badge
        type="success"
        text="Completed"/>

@elseif($payment->status=='Pending')

    <x-admin.badge
        type="warning"
        text="Pending"/>

@else

    <x-admin.badge
        type="danger"
        text="{{ $payment->status }}"/>

@endif

</td>

<td class="px-6 py-4">

<div class="flex justify-center gap-2">

<a href="{{ route('payments.edit',$payment) }}">

<x-admin.button color="blue">

<i class="bi bi-pencil"></i>

</x-admin.button>

</a>

<form
method="POST"
action="{{ route('payments.destroy',$payment) }}">

@csrf
@method('DELETE')

<x-admin.button
color="red"
onclick="return confirm('Delete this payment?')">

<i class="bi bi-trash"></i>

</x-admin.button>

</form>

</div>

</td>

</tr>

@empty

<tr>

<td colspan="7" class="py-10 text-center text-gray-500">

No payment records found.

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

<div class="mt-6">

{{ $payments->links() }}

</div>

</x-admin.card>

@endsection