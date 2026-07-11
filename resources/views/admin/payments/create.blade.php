@extends('layouts.admin')

@section('page-title','Record Payment')

@section('content')

<x-admin.page-header
    title="Record Payment"
    subtitle="Record a student's hostel payment">

</x-admin.page-header>

<form
    method="POST"
    action="{{ route('payments.store') }}">

    @csrf

    <x-admin.form-card>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            {{-- Student --}}
            <div>

                <x-admin.select
                    label="Student"
                    name="student_id"
                    required>

                    <option value="">Select Student</option>

                    @foreach($students as $student)

                        @php
                            $payment = $student->payments
                                ->where('status','Pending')
                                ->first();
                        @endphp

                        @if($payment)

                            <option
                                value="{{ $student->id }}"
                                {{ old('student_id') == $student->id ? 'selected' : '' }}>

                                {{ $student->user->name }}
                                ({{ $student->registration_number }})

                            </option>

                        @endif

                    @endforeach

                </x-admin.select>

                <p class="mt-2 text-xs text-slate-500">

                    Only students with pending payments are displayed.

                </p>

            </div>

            {{-- Amount --}}
            <x-admin.input
                label="Amount (KES)"
                name="amount"
                type="number"
                required
                placeholder="Enter payment amount" />

            {{-- Payment Method --}}
            <x-admin.select
                label="Payment Method"
                name="payment_method"
                required>

                <option
                    value="Cash"
                    {{ old('payment_method') == 'Cash' ? 'selected' : '' }}>

                    Cash

                </option>

                <option
                    value="Bank"
                    {{ old('payment_method') == 'Bank' ? 'selected' : '' }}>

                    Bank

                </option>

                <option
                    value="M-Pesa"
                    {{ old('payment_method') == 'M-Pesa' ? 'selected' : '' }}>

                    M-Pesa

                </option>

                <option
                    value="Card"
                    {{ old('payment_method') == 'Card' ? 'selected' : '' }}>

                    Card

                </option>

            </x-admin.select>

            {{-- Transaction Reference --}}
            <x-admin.input
                label="Transaction Reference"
                name="transaction_reference"
                required
                placeholder="e.g. QWE123XYZ" />

            {{-- Payment Date --}}
            <x-admin.input
                label="Payment Date"
                name="payment_date"
                type="date"
                :value="old('payment_date', date('Y-m-d'))"
                required />

        </div>

        <x-admin.form-actions
            :cancel="route('payments.index')"
            submit="Save Payment" />

    </x-admin.form-card>

</form>

@endsection