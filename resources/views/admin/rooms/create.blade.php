@extends('layouts.admin')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    Add Room
</h1>

<a href="{{ route('rooms.index') }}"
   class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-6">

    <i class="bi bi-arrow-left me-2"></i>

    Back to Rooms

</a>

<div class="bg-white p-6 rounded-2xl shadow-sm">

@if ($errors->any())

<div class="bg-red-100 border border-red-300 text-red-700 rounded-xl p-4 mb-6">

    <strong>Please fix the following errors:</strong>

    <ul class="list-disc ml-6 mt-2">

        @foreach ($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif

<form method="POST"
      action="{{ route('rooms.store') }}"
      class="space-y-6">

@csrf

<div class="grid grid-cols-2 gap-6">

    <div>
        <label class="block mb-2 font-medium text-gray-700">
           Hostel
        </label>

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
        <label class="block mb-2 font-medium text-gray-700">
           Room Number
        </label>

        <input
            type="text"
            name="room_number"
            class="w-full border p-3 rounded-lg">
    </div>

    <div>
        <label class="block mb-2 font-medium text-gray-700">
           Floor
        </label>

        <input
            type="number"
            name="floor"
            class="w-full border p-3 rounded-lg"
            value="1">
    </div>

    <div>
        <label class="block mb-2 font-medium text-gray-700">
           Capacity
        </label>

        <input
            type="number"
            name="capacity"
            class="w-full border p-3 rounded-lg">
    </div>

    <div>
        <label class="block mb-2 font-medium text-gray-700">
           Price
        </label>

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