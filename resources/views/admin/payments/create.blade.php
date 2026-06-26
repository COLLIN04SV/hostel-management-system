@extends('layouts.admin')

@section('content')

<div class="container">

    <h2 class="mb-4">Record Payment</h2>

    <form action="/payments/store" method="POST">
        @csrf

        <div class="mb-3">
            <label>Student</label>

            <select name="student_id" required>
               <option value="">Select Student</option>

               @foreach($students as $student)
               <option value="{{ $student->id }}">
                  {{ $student->user->name }}
                 ({{ $student->registration_number }})
               </option>
                 @endforeach
           </select>
        </div>

        <div class="mb-3">
            <label>Amount</label>

            <input
                type="number"
                name="amount"
                class="form-control"
                required>
        </div>

        <div class="mb-3">
            <label>Payment Method</label>

            <select
                name="payment_method"
                class="form-control">

                <option>Cash</option>
                <option>Bank</option>
                <option>M-Pesa</option>
                <option>Card</option>

            </select>
        </div>

        <div class="mb-3">
            <label>Reference</label>

            <input
                type="text"
                name="transaction_reference"
                class="form-control"
                required>
        </div>

        <div class="mb-3">
            <label>Date</label>

            <input
                type="date"
                name="payment_date"
                class="form-control"
                required>
        </div>

        <button class="btn btn-primary">
            Save Payment
        </button>

    </form>

</div>

@endsection