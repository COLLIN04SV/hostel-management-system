<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Hostel Management Report</title>

<style>

body{
    font-family: DejaVu Sans, sans-serif;
    font-size:12px;
    color:#333;
}

h1{
    text-align:center;
    margin-bottom:5px;
}

h3{
    margin-top:30px;
    margin-bottom:10px;
    color:#1e3a8a;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-bottom:20px;
}

table th{
    background:#1e40af;
    color:white;
    padding:8px;
    border:1px solid #ddd;
}

table td{
    border:1px solid #ddd;
    padding:7px;
}

.summary{
    width:100%;
    margin-bottom:20px;
}

.summary td{
    border:none;
    padding:5px 0;
}

.footer{
    text-align:center;
    margin-top:40px;
    font-size:11px;
    color:#777;
}

</style>

</head>

<body>

<h1>

HOSTEL MANAGEMENT SYSTEM

</h1>

<p style="text-align:center">

Administrative Report

</p>

@if(request('from') || request('to'))

<p style="text-align:center">

Period :

{{ request('from') ?: 'Beginning' }}

-

{{ request('to') ?: now()->format('Y-m-d') }}

</p>

@endif



<h3>

Report Summary

</h3>

<table class="summary">

<tr>

<td>Total Students</td>

<td><strong>{{ $totalStudents }}</strong></td>

</tr>

<tr>

<td>Allocated Students</td>

<td><strong>{{ $allocatedStudents }}</strong></td>

</tr>

<tr>

<td>Revenue Collected</td>

<td>

<strong>

KSh {{ number_format($totalRevenue) }}

</strong>

</td>

</tr>

<tr>

<td>Outstanding Balance</td>

<td>

<strong>

KSh {{ number_format($outstandingBalance) }}

</strong>

</td>

</tr>

<tr>

<td>Occupancy Rate</td>

<td>

<strong>

{{ $occupancyRate }}%

</strong>

</td>

</tr>

</table>



<h3>

Student Payment Report

</h3>

<table>

<thead>

<tr>

<th>Student</th>

<th>Registration</th>

<th>Room Fee</th>

<th>Paid</th>

<th>Balance</th>

<th>Status</th>

</tr>

</thead>

<tbody>

@foreach($studentAccounts as $account)

<tr>

<td>

{{ $account->student->user->name }}

</td>

<td>

{{ $account->student->registration_number }}

</td>

<td>

KSh {{ number_format($account->room_fee) }}

</td>

<td>

KSh {{ number_format($account->amount_paid) }}

</td>

<td>

KSh {{ number_format($account->balance) }}

</td>

<td>

{{ $account->status }}

</td>

</tr>

@endforeach

</tbody>

</table>



<h3>

Hostel Occupancy Report

</h3>

<table>

<thead>

<tr>

<th>Hostel</th>

<th>Capacity</th>

<th>Occupied</th>

<th>Available</th>

<th>Occupancy</th>

</tr>

</thead>

<tbody>

@foreach($hostels as $hostel)

@php

$capacity = $hostel->rooms->sum('capacity');

$occupied = $hostel->rooms->sum('occupied');

$available = $capacity - $occupied;

$rate = $capacity > 0
? round(($occupied/$capacity)*100)
: 0;

@endphp

<tr>

<td>

{{ $hostel->name }}

</td>

<td>

{{ $capacity }}

</td>

<td>

{{ $occupied }}

</td>

<td>

{{ $available }}

</td>

<td>

{{ $rate }}%

</td>

</tr>

@endforeach

</tbody>

</table>



<h3>

Recent Room Allocations

</h3>

<table>

<thead>

<tr>

<th>Student</th>

<th>Hostel</th>

<th>Room</th>

<th>Date</th>

<th>Status</th>

</tr>

</thead>

<tbody>

@foreach($recentAllocations as $allocation)

<tr>

<td>

{{ $allocation->student->user->name }}

</td>

<td>

{{ $allocation->room->hostel->name }}

</td>

<td>

{{ $allocation->room->room_number }}

</td>

<td>

{{ \Carbon\Carbon::parse($allocation->allocated_date)->format('d M Y') }}

</td>

<td>

{{ $allocation->status }}

</td>

</tr>

@endforeach

</tbody>

</table>



<h3>

Recent Payments

</h3>

<table>

<thead>

<tr>

<th>Student</th>

<th>Amount</th>

<th>Method</th>

<th>Reference</th>

<th>Date</th>

</tr>

</thead>

<tbody>

@foreach($recentPayments as $payment)

<tr>

<td>

{{ $payment->student->user->name }}

</td>

<td>

KSh {{ number_format($payment->amount) }}

</td>

<td>

{{ $payment->payment_method }}

</td>

<td>

{{ $payment->transaction_reference }}

</td>

<td>

{{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y') }}

</td>

</tr>

@endforeach

</tbody>

</table>



<div class="footer">

Generated on

{{ now()->format('d M Y H:i') }}

<br>

Hostel Management System

</div>

</body>

</html>