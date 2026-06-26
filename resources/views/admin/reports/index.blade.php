@extends('layouts.admin')

@section('content')

<div class="container">

    <h2 class="mb-4">Reports Dashboard</h2>

    <div class="row">

        <div class="col-md-3">
            <div class="card p-3 mb-3">
                <h6>Total Students</h6>
                <h3>{{ $totalStudents }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3 mb-3">
                <h6>Allocated Students</h6>
                <h3>{{ $allocatedStudents }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3 mb-3">
                <h6>Unallocated Students</h6>
                <h3>{{ $unallocatedStudents }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3 mb-3">
                <h6>Total Rooms</h6>
                <h3>{{ $totalRooms }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3 mb-3">
                <h6>Occupied Rooms</h6>
                <h3>{{ $occupiedRooms }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3 mb-3">
                <h6>Vacant Rooms</h6>
                <h3>{{ $vacantRooms }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3 mb-3">
                <h6>Total Payments</h6>
                <h3>{{ $totalPayments }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3 mb-3">
                <h6>Total Collected</h6>
                <h3>KSh {{ number_format($totalCollected) }}</h3>
            </div>
        </div>

    </div>

</div>

@endsection