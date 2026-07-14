<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Hostel Payment Receipt</title>

<style>

body{
    font-family: DejaVu Sans, sans-serif;
    font-size:13px;
    color:#333;
    margin:35px;
}

.header{
    text-align:center;
    border-bottom:3px solid #1e40af;
    padding-bottom:18px;
    margin-bottom:25px;
}

.logo{
    font-size:20px;
    font-weight:bold;
    color:#1e40af;
    margin-bottom:6px;
}

.title{
    font-size:24px;
    font-weight:bold;
    color:#1e40af;
}

.subtitle{
    font-size:13px;
    color:#666;
    margin-top:4px;
}

.receipt-title{
    text-align:center;
    margin:25px 0;
    font-size:18px;
    font-weight:bold;
    color:#111827;
}

.info{
    margin-bottom:20px;
}

.info table{
    width:100%;
}

.info td{
    border:none;
    padding:3px 0;
}

.reference{
    text-align:right;
}

.reference strong{
    color:#1e40af;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:10px;
}

th{
    background:#1e40af;
    color:white;
    padding:10px;
    border:1px solid #d1d5db;
    text-align:left;
}

td{
    border:1px solid #d1d5db;
    padding:10px;
}

.label{
    width:35%;
    background:#f8fafc;
    font-weight:bold;
}

.amount{
    font-size:18px;
    color:#059669;
    font-weight:bold;
}

.status-paid{
    display:inline-block;
    padding:5px 12px;
    background:#dcfce7;
    color:#15803d;
    font-weight:bold;
    border-radius:4px;
}

.status-pending{
    display:inline-block;
    padding:5px 12px;
    background:#fef3c7;
    color:#b45309;
    font-weight:bold;
    border-radius:4px;
}

.status-failed{
    display:inline-block;
    padding:5px 12px;
    background:#fee2e2;
    color:#b91c1c;
    font-weight:bold;
    border-radius:4px;
}

</style>

</head>

<body>

<div class="header">

<div class="logo">

HOSTEL MANAGEMENT SYSTEM

</div>

<div class="title">

PAYMENT RECEIPT

</div>

<div class="subtitle">

Official Hostel Fee Payment Receipt

</div>

</div>

<div class="info">

<table>

<tr>

<td>

<strong>Student:</strong>

{{ $student->user->name }}

</td>

<td class="reference">

<strong>Receipt No:</strong>

#{{ str_pad($payment->id,6,'0',STR_PAD_LEFT) }}

</td>

</tr>

<tr>

<td>

<strong>Registration Number:</strong>

{{ $student->registration_number }}

</td>

<td class="reference">

<strong>Date:</strong>

{{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y') }}

</td>

</tr>

</table>

</div>

<div class="receipt-title">

PAYMENT DETAILS

</div>

<table>

<tr>

<th colspan="2">

Payment Information

</th>

</tr>

<tr>

<td class="label">

Receipt Number

</td>

<td>

#{{ str_pad($payment->id,6,'0',STR_PAD_LEFT) }}

</td>

</tr>

<tr>

<td class="label">

Student Name

</td>

<td>

{{ $student->user->name }}

</td>

</tr>

<tr>

<td class="label">

Registration Number

</td>

<td>

{{ $student->registration_number }}

</td>

</tr>

<tr>

<td class="label">

Payment Method

</td>

<td>

{{ $payment->payment_method }}

</td>

</tr>

<tr>

<td class="label">

Transaction Reference

</td>

<td>

{{ $payment->transaction_reference }}

</td>

</tr>

<tr>

<td class="label">

Payment Date

</td>

<td>

{{ \Carbon\Carbon::parse($payment->payment_date)->format('d F Y') }}

</td>

</tr>

<tr>

<td class="label">

Amount Paid

</td>

<td class="amount">

KES {{ number_format($payment->amount,2) }}

</td>

</tr>

<tr>

<td class="label">

Payment Status

</td>

<td>

@if($payment->status=='Completed')

<span class="status-paid">

PAID

</span>

@elseif($payment->status=='Pending')

<span class="status-pending">

PENDING

</span>

@else

<span class="status-failed">

FAILED

</span>

@endif

</td>

</tr>

</table>

<div style="margin-top:45px;">

<table style="border:none;">

<tr>

<td style="border:none;width:60%;">

<strong>Remarks</strong>

<br><br>

This receipt confirms that the above payment has been successfully recorded in the Hostel Management System.

</td>

<td style="border:none;text-align:center;">

<div style="font-size:34px;font-weight:bold;color:#16a34a;border:3px solid #16a34a;padding:10px 25px;display:inline-block;transform:rotate(-12deg);">

PAID

</div>

</td>

</tr>

</table>

</div>

<div style="margin-top:70px;">

<table style="border:none;">

<tr>

<td style="border:none;text-align:center;">

_____________________________

<br>

Finance Officer

</td>

<td style="border:none;text-align:center;">

_____________________________

<br>

Student Signature

</td>

</tr>

</table>

</div>

<div style="margin-top:60px;border-top:1px solid #d1d5db;padding-top:15px;text-align:center;color:#6b7280;font-size:11px;">

This is an electronically generated receipt from the Hostel Management System.

<br>

No signature is required for system-generated copies.

<br><br>

© {{ date('Y') }} Hostel Management System. All Rights Reserved.

</div>

</body>

</html>