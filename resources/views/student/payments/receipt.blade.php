<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Payment Receipt</title>

<style>

body{
    font-family: DejaVu Sans,sans-serif;
    font-size:14px;
    color:#333;
}

.header{
    text-align:center;
    border-bottom:2px solid #1e3a8a;
    padding-bottom:15px;
    margin-bottom:25px;
}

.header h1{
    margin:0;
    color:#1e3a8a;
}

.header h3{
    margin:5px 0;
}

table{
    width:100%;
    border-collapse:collapse;
}

td{
    padding:10px;
    border:1px solid #ddd;
}

.label{
    width:35%;
    font-weight:bold;
    background:#f5f5f5;
}

.paid{
    margin-top:40px;
    text-align:right;
    color:green;
    font-size:30px;
    font-weight:bold;
}

.footer{
    margin-top:60px;
    text-align:center;
    font-size:12px;
    color:#666;
}

</style>

</head>

<body>

<div class="header">

    <h1>HOSTEL MANAGEMENT SYSTEM</h1>

    <h3>OFFICIAL PAYMENT RECEIPT</h3>

</div>

<table>

<tr>

<td class="label">Receipt Number</td>

<td>#{{ $payment->id }}</td>

</tr>

<tr>

<td class="label">Student Name</td>

<td>{{ auth()->user()->name }}</td>

</tr>

<tr>

<td class="label">Registration Number</td>

<td>{{ $student->registration_number }}</td>

</tr>

<tr>

<td class="label">Amount Paid</td>

<td>KES {{ number_format($payment->amount) }}</td>

</tr>

<tr>

<td class="label">Payment Method</td>

<td>{{ $payment->payment_method }}</td>

</tr>

<tr>

<td class="label">Transaction Reference</td>

<td>{{ $payment->transaction_reference }}</td>

</tr>

<tr>

<td class="label">Payment Date</td>

<td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y') }}</td>

</tr>

<tr>

<td class="label">Status</td>

<td>{{ $payment->status }}</td>

</tr>

</table>

<div class="paid">

PAID

</div>

<div class="footer">

This receipt was generated electronically by the Hostel Management System.

</div>

</body>

</html>