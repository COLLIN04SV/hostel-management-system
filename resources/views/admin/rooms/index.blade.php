@extends('layouts.admin')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    Rooms
</h1>

<a href="{{ route('rooms.create') }}"
   class="bg-blue-600 text-white px-5 py-3 rounded-xl">

   Add Room

</a>

<div class="bg-white rounded-2xl shadow-sm p-6 mt-6">

<table class="w-full">

<thead>

<tr class="border-b">

    <th>Hostel</th>
    <th>Room</th>
    <th>Capacity</th>
    <th>Occupied</th>
    <th>Available</th>
    <th>Price</th>

</tr>

</thead>

<tbody>

@foreach($rooms as $room)

<tr class="border-b">

    <td>{{ $room->hostel->name }}</td>

    <td>{{ $room->room_number }}</td>

    <td>{{ $room->capacity }}</td>

    <td>{{ $room->occupied }}</td>

    <td>

     @if($room->availableBeds() > 0)

     <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">
      {{ $room->availableBeds() }}
     </span>

      @else

     <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full">
       Full
     </span>

      @endif

    </td>

    <td>{{ $room->price }}</td>

    <td>{{ $room->occupiedBeds() }}</td>


</tr>

@endforeach

</tbody>

</table>

</div>

@endsection