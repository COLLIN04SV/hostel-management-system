@extends('layouts.admin')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    Edit Room
</h1>

<div class="bg-white p-6 rounded-2xl shadow-sm">

<form method="POST" action="{{ route('rooms.update', $room->id) }}">

    @csrf
    @method('PUT')

<div class="grid grid-cols-2 gap-6">

    <div>
        <label class="block mb-2 font-medium">
            Hostel
        </label>

        <select
            name="hostel_id"
            class="w-full border p-3 rounded-lg">

            @foreach($hostels as $hostel)

                <option
                    value="{{ $hostel->id }}"
                    {{ $room->hostel_id == $hostel->id ? 'selected' : '' }}>

                    {{ $hostel->name }}

                </option>

            @endforeach

        </select>

    </div>

    <div>

        <label class="block mb-2 font-medium">
            Room Number
        </label>

        <input
            type="text"
            name="room_number"
            value="{{ old('room_number', $room->room_number) }}"
            class="w-full border p-3 rounded-lg">

    </div>

    <div>

        <label class="block mb-2 font-medium">
            Floor
        </label>

        <input
            type="number"
            name="floor"
            value="{{ old('floor', $room->floor) }}"
            class="w-full border p-3 rounded-lg">

    </div>

    <div>

        <label class="block mb-2 font-medium">
            Capacity
        </label>

        <input
            type="number"
            name="capacity"
            value="{{ old('capacity', $room->capacity) }}"
            class="w-full border p-3 rounded-lg">

    </div>

    <div>

        <label class="block mb-2 font-medium">
            Price
        </label>

        <input
            type="number"
            step="0.01"
            name="price"
            value="{{ old('price', $room->price) }}"
            class="w-full border p-3 rounded-lg">

    </div>

    <div>

        <label class="block mb-2 font-medium">
            Status
        </label>

        <select
            name="status"
            class="w-full border p-3 rounded-lg">

            <option value="1" {{ $room->status ? 'selected' : '' }}>
                Active
            </option>

            <option value="0" {{ !$room->status ? 'selected' : '' }}>
                Inactive
            </option>

        </select>

    </div>

</div>

<button
    class="mt-6 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl">

    Update Room

</button>

</form>

</div>

@endsection