@extends('student.layouts.app')

@section('title', 'Dashboard')

@section('student-content')

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

  <div class="card">
    <h5>Hostel</h5>

    <h3>
        {{ $allocation?->room?->hostel?->name ?? 'Not Allocated' }}
    </h3>
  </div>

  <div class="card">
    <h5>Room</h5>

    <h3>
        {{ $allocation?->room?->room_number ?? 'Not Allocated' }}
    </h3>
  </div>

  <div class="card">
    <h5>Status</h5>

    <h3>
        {{ $allocation?->status ?? 'No Allocation' }}
    </h3>
  </div>

  @if($allocation)

<div class="card mt-4 p-4">

    <h3>Room Details</h3>

    <p>
        Room Number:
        {{ $allocation->room->room_number }}
    </p>

    <p>
        Floor:
        {{ $allocation->room->floor }}
    </p>

    <p>
        Capacity:
        {{ $allocation->room->capacity }}
    </p>

    <p>
        Occupied:
        {{ $allocation->room->occupied }}
    </p>

    <p>
        Price:
        KES {{ number_format($allocation->room->price) }}
    </p>

</div>

@endif
  
</div>

@endsection