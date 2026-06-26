@extends('layouts.admin')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    Add Room
</h1>

<div class="bg-white p-6 rounded-2xl shadow-sm">

<form method="POST" action="{{ route('rooms.store') }}">

@csrf

<div class="grid grid-cols-2 gap-6">

    <div>
        <label>Hostel</label>

        <select
            name="hostel_id"
            class="w-full border p-3 rounded-lg">

            @foreach($hostels as $hostel)

            <option value="{{ $hostel->id }}">
                {{ $hostel->name }}
            </option>

            @endforeach

        </select>
    </div>

    <div>
        <label>Room Number</label>

        <input
            type="text"
            name="room_number"
            class="w-full border p-3 rounded-lg">
    </div>

    <div>
        <label>Floor</label>

        <input
            type="number"
            name="floor"
            class="w-full border p-3 rounded-lg"
            value="1">
    </div>

    <div>
        <label>Capacity</label>

        <input
            type="number"
            name="capacity"
            class="w-full border p-3 rounded-lg">
    </div>

    <div>
        <label>Price</label>

        <input
            type="number"
            step="0.01"
            name="price"
            class="w-full border p-3 rounded-lg">
    </div>

</div>

<button
    class="mt-6 bg-blue-600 text-white px-6 py-3 rounded-xl">

    Save Room

</button>

</form>

</div>

@endsection