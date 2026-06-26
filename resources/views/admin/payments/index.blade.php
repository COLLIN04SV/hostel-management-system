@extends('layouts.admin')

@section('content')

<div class="bg-white p-6 rounded-xl shadow">

    <div class="flex justify-between mb-6">

        <h2 class="text-2xl font-bold">
            Payments
        </h2>

        <a href="/payments/create"
        class="bg-blue-600 text-white px-4 py-2 rounded">
           Record Payment
        </a>

    </div>

    @if(session('success'))

    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        {{ session('success') }}
    </div>

    @endif

    <div class="row mb-4">

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Total Payments</h6>
                <h3>{{ $totalPayments }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Total Collected</h6>
                <h3>KSh {{ number_format($totalCollected) }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Pending Payments</h6>
                <h3>{{ $pendingPayments }}</h3>
            </div>
        </div>
    </div>

    </div>

    <table class="w-full">

        <thead>
            <tr class="border-b">
                <th class="p-3 text-left">Student</th>
                <th class="p-3 text-left">Amount</th>
                <th class="p-3 text-left">Method</th>
                <th class="p-3 text-left">Reference</th>
                <th class="p-3 text-left">Date</th>
                <th class="p-3 text-left">Status</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

        @foreach($payments as $payment)

        <tr>

           <td>{{ $payment->student->user->name ?? 'No Name' }}</td>

           <td>KSh {{ number_format($payment->amount) }}</td>

           <td>{{ $payment->payment_method }}</td>

           <td>{{ $payment->transaction_reference }}</td>

           <td>{{ $payment->payment_date }}</td>

           <td>{{ $payment->status }}</td>

           <td>

             <a href="{{ route('payments.edit',$payment->id) }}"
               class="btn btn-sm btn-warning">

               Edit

             </a>

             <form action="{{ route('payments.destroy',$payment->id) }}"
              method="POST"
              style="display:inline">

               @csrf
               @method('DELETE')

             <button class="btn btn-sm btn-danger"
                onclick="return confirm('Delete payment?')">

                Delete

               </button>

             </form>

          </td>

         </tr>

        @endforeach

        </tbody>

</div>

@endsection