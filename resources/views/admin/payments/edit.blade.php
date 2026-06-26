@extends('layouts.admin')

@section('content')

<div class="container">

    <h3>Edit Payment</h3>

    <form action="{{ route('payments.update',$payment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Student</label>

            <select name="student_id" class="form-control">

                @foreach($students as $student)

                <option value="{{ $student->id }}"
                    {{ $payment->student_id == $student->id ? 'selected' : '' }}>

                    {{ $student->user->name ?? $student->registration_number }}

                </option>

                @endforeach

            </select>
        </div>

        <div class="mb-3">
            <label>Amount</label>

            <input type="number"
                   name="amount"
                   class="form-control"
                   value="{{ $payment->amount }}">
        </div>

        <div class="mb-3">
            <label>Method</label>

            <select name="payment_method" class="form-control">
                <option value="Cash">Cash</option>
                <option value="Bank">Bank</option>
                <option value="M-Pesa">M-Pesa</option>
                <option value="Card">Card</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Reference</label>

            <input type="text"
                   name="transaction_reference"
                   class="form-control"
                   value="{{ $payment->transaction_reference }}">
        </div>

        <div class="mb-3">
            <label>Date</label>

            <input type="date"
                   name="payment_date"
                   class="form-control"
                   value="{{ $payment->payment_date }}">
        </div>

        <button class="btn btn-primary">
            Update Payment
        </button>

    </form>

</div>

@endsection