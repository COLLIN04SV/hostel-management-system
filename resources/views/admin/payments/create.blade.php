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

                    <option value="">
                        Select Student
                    </option>

                    @foreach($students as $student)

                        @php

                            $account = $student->account;

                        @endphp

                        @if($account && $account->status != 'Completed')

                            <option
                                value="{{ $student->id }}"
                                {{ old('student_id') == $student->id ? 'selected' : '' }}>

                                {{ $student->user->name }}
                                ({{ $student->registration_number }})

                                - Balance:
                                KSh {{ number_format($account->balance) }}

                            </option>

                        @endif

                    @endforeach

                </x-admin.select>

                <p class="mt-2 text-xs text-slate-500">

                    Only students with an outstanding hostel balance are displayed.

                </p>

            </div>

                        {{-- Amount --}}
            <x-admin.input
                label="Amount (KES)"
                name="amount"
                type="number"
                :value="old('amount')"
                required
                placeholder="Enter amount received" />

            {{-- Payment Method --}}
            <x-admin.select
                label="Payment Method"
                name="payment_method"
                required>

                <option value="">
                    Select Payment Method
                </option>

                <option
                    value="Cash"
                    {{ old('payment_method') == 'Cash' ? 'selected' : '' }}>
                    Cash
                </option>

                <option
                    value="M-Pesa"
                    {{ old('payment_method') == 'M-Pesa' ? 'selected' : '' }}>
                    M-Pesa
                </option>

                <option
                    value="Bank"
                    {{ old('payment_method') == 'Bank' ? 'selected' : '' }}>
                    Bank
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
                :value="old('transaction_reference')"
                required
                placeholder="e.g. MPESA123ABC" />

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
            submit="Record Payment" />

    </x-admin.form-card>

</form>

@endsection