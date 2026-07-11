@extends('layouts.admin')

@section('page-title','Edit Payment')

@section('content')

<x-admin.page-header
    title="Edit Payment"
    subtitle="Update an existing payment record">

</x-admin.page-header>

<form
    method="POST"
    action="{{ route('payments.update', $payment) }}">

    @csrf
    @method('PUT')

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

                        <option
                            value="{{ $student->id }}"
                            {{ old('student_id', $payment->student_id) == $student->id ? 'selected' : '' }}>

                            {{ $student->user->name }}
                            ({{ $student->registration_number }})

                        </option>

                    @endforeach

                </x-admin.select>

            </div>

            {{-- Amount --}}
            <x-admin.input
                label="Amount (KES)"
                name="amount"
                type="number"
                :value="$payment->amount"
                required />

            {{-- Payment Method --}}
            <x-admin.select
                label="Payment Method"
                name="payment_method"
                required>

                <option
                    value="Cash"
                    {{ old('payment_method', $payment->payment_method) == 'Cash' ? 'selected' : '' }}>

                    Cash

                </option>

                <option
                    value="Bank"
                    {{ old('payment_method', $payment->payment_method) == 'Bank' ? 'selected' : '' }}>

                    Bank

                </option>

                <option
                    value="M-Pesa"
                    {{ old('payment_method', $payment->payment_method) == 'M-Pesa' ? 'selected' : '' }}>

                    M-Pesa

                </option>

                <option
                    value="Card"
                    {{ old('payment_method', $payment->payment_method) == 'Card' ? 'selected' : '' }}>

                    Card

                </option>

            </x-admin.select>

            {{-- Transaction Reference --}}
            <x-admin.input
                label="Transaction Reference"
                name="transaction_reference"
                :value="$payment->transaction_reference"
                required />

            {{-- Payment Date --}}
            <x-admin.input
                label="Payment Date"
                name="payment_date"
                type="date"
                :value="old('payment_date', \Carbon\Carbon::parse($payment->payment_date)->format('Y-m-d'))"
                required />

            {{-- Status --}}
            <x-admin.select
                label="Status"
                name="status"
                required>

                <option
                    value="Pending"
                    {{ old('status', $payment->status) == 'Pending' ? 'selected' : '' }}>

                    Pending

                </option>

                <option
                    value="Completed"
                    {{ old('status', $payment->status) == 'Completed' ? 'selected' : '' }}>

                    Completed

                </option>

                <option
                    value="Failed"
                    {{ old('status', $payment->status) == 'Failed' ? 'selected' : '' }}>

                    Failed

                </option>

            </x-admin.select>

        </div>

        <x-admin.form-actions
            :cancel="route('payments.index')"
            submit="Update Payment" />

    </x-admin.form-card>

</form>

@endsection