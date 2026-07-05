@extends('layouts.admin')

@section('page-title','Record Payment')

@section('content')

<x-admin.page-header
    title="Record Payment"
    subtitle="Record a student's hostel payment"/>

<x-admin.card>

<form
    method="POST"
    action="{{ route('payments.store') }}">

@csrf

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <div>

        <label class="block mb-2 font-semibold">

            Student

        </label>

        <select
            name="student_id"
            class="w-full border rounded-xl px-4 py-3"
            required>

            <option value="">

                Select Student

            </option>

            @foreach($students as $student)

            @php

            $payment = $student->payments
             ->where('status','Pending')
             ->first();

            @endphp

            @if($payment)

           <option value="{{ $student->id }}">

              {{ $student->user->name }}
              ({{ $student->registration_number }})

           </option>

         @endif

         @endforeach

        </select>

         <p class="text-sm text-gray-500 mt-2">

             Only students with pending payments are displayed.

         </p>

    </div>

    <div>

        <label class="block mb-2 font-semibold">

            Amount

        </label>

        <input
            type="number"
            name="amount"
            class="w-full border rounded-xl px-4 py-3"
            required>

    </div>

    <div>

        <label class="block mb-2 font-semibold">

            Payment Method

        </label>

        <select
            name="payment_method"
            class="w-full border rounded-xl px-4 py-3">

            <option value="Cash">Cash</option>

            <option value="Bank">Bank</option>

            <option value="M-Pesa">M-Pesa</option>

            <option value="Card">Card</option>

        </select>

    </div>

    <div>

        <label class="block mb-2 font-semibold">

            Transaction Reference

        </label>

        <input
            type="text"
            name="transaction_reference"
            class="w-full border rounded-xl px-4 py-3"
            required>

    </div>

    <div>

        <label class="block mb-2 font-semibold">

            Payment Date

        </label>

        <input
            type="date"
            name="payment_date"
            value="{{ date('Y-m-d') }}"
            class="w-full border rounded-xl px-4 py-3"
            required>

    </div>

</div>

<div class="flex justify-end gap-3 mt-8">

    <a href="{{ route('payments.index') }}">

        <x-admin.button color="gray">

            Cancel

        </x-admin.button>

    </a>

    <x-admin.button
        color="blue"
        type="submit">

        <i class="bi bi-check-circle mr-2"></i>

        Save Payment

    </x-admin.button>

</div>

</form>

</x-admin.card>

@endsection