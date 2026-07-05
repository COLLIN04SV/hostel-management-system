@extends('layouts.admin')

@section('content')
<x-admin.alert />

<h1 class="text-3xl font-bold mb-6">
    Rooms
</h1>

<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-6 mb-6">

<x-admin.stat-card
title="Total Rooms"
:value="$totalRooms"
icon="bi-door-open"
color="blue"/>

<x-admin.stat-card
title="Occupied"
:value="$occupiedRooms"
icon="bi-house-lock"
color="red"/>

<x-admin.stat-card
title="Available"
:value="$availableRooms"
icon="bi-check-circle"
color="green"/>

<x-admin.stat-card
title="Occupancy"
:value="$occupancyRate.'%'"
icon="bi-bar-chart"
color="yellow"/>

</div>

    <div class="flex justify-between items-center mb-6">

       <x-admin.search />

       <a href="{{ route('rooms.create') }}">
        <x-admin.button>
            <i class="bi bi-plus-circle me-2"></i>
            Add Room
        </x-admin.button>
       </a>

    </div>

<x-admin.card class="mt-6">

<table class="min-w-full divide-y divide-gray-200">

<thead>

<tr class="bg-gray-50 text-gray-700 uppercase text-sm">

    <th class="px-6 py-4 text-left">Hostel</th>
    <th class="py-6 px-4 text-center">Room</th>
    <th class="py-6 px-4 text-center">Capacity</th>
    <th class="py-6 px-4 text-center">Occupied</th>
    <th class="py-6 px-4 text-center">Available</th>
    <th class="py-6 px-4 text-center">Price</th>
    <th class="py-6 px-4 text-center">Status</th>
    <th class="py-6 px-4 text-center">Actions</th>

</tr>

</thead>

<tbody>

@forelse($rooms as $room)

<tr class="border-b hover:bg-gray-50 transition">

    <td class="px-6 py-4">
        {{ $room->hostel->name }}
    </td>

    <td class="px-6 py-4">
        {{ $room->room_number }}
    </td>

    <td class="px-6 py-4 text-center">

    <x-admin.badge type="info">
        {{ $room->capacity }} Beds
    </x-admin.badge>

</td>

<td class="px-6 py-4 text-center">

    <x-admin.badge type="warning">
        {{ $room->occupied }} Occupied
    </x-admin.badge>

</td>

<td class="px-6 py-4 text-center">

    @if($room->availableBeds() > 0)

        <x-admin.badge type="success">
            {{ $room->availableBeds() }} Free
        </x-admin.badge>

    @else

        <x-admin.badge type="danger">
            Full
        </x-admin.badge>

    @endif

</td>

    <td class="px-6 py-4 text-right">
        KES {{ number_format($room->price,2) }}
    </td>

    <td class="px-6 py-4 text-center">

        @if($room->status)

            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                Active
            </span>

        @else

            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                Inactive
            </span>

        @endif

    </td>

   <td class="text-center">

    <div class="flex justify-center gap-2">

        <a href="{{ route('rooms.edit', $room) }}"
           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-lg">

            <i class="bi bi-pencil-square"></i>

        </a>

        <form action="{{ route('rooms.destroy', $room) }}"
              method="POST">

            @csrf
            @method('DELETE')

            <button
                onclick="return confirm('Delete this room?')"
                class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg">

                <i class="bi bi-trash"></i>

            </button>

        </form>

    </div>

</td>
</tr>

@empty

<tr>

<td colspan="8" class="text-center py-12">

<i class="bi bi-door-open text-5xl text-gray-300"></i>

<p class="mt-4 text-gray-500">

No rooms found.

</p>

</td>

</tr>

@endforelse

</tbody>

</table>

<div class="mt-6">

{{ $rooms->links() }}

</div>

</x-admin.card>


@endsection