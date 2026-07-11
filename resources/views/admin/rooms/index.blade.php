@extends('layouts.admin')

@section('title','Rooms')

@section('page-title','Rooms')

@section('page-description','Manage hostel rooms')

@section('content')

<x-admin.alert/>

<x-admin.page-header
    title="Rooms"
    subtitle="Manage hostel rooms">

    <x-admin.button
        href="{{ route('rooms.create') }}">

        <i class="bi bi-plus-circle me-2"></i>

        Add Room

    </x-admin.button>

</x-admin.page-header>

<x-admin.stats-grid>

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

</x-admin.stats-grid>

<x-admin.table>

<x-admin.search-bar
    :action="route('rooms.index')"
    placeholder="Search room number or hostel..." />

<div class="flex items-center justify-between mb-5">

    <p class="text-sm text-slate-500">

        Showing

        <strong>{{ $rooms->firstItem() ?? 0 }}</strong>

        -

        <strong>{{ $rooms->lastItem() ?? 0 }}</strong>

        of

        <strong>{{ $rooms->total() }}</strong>

        rooms

    </p>

</div>

<table class="min-w-full">

<thead class="bg-slate-50 border-b">

<tr>

<x-admin.table-heading>

Hostel

</x-admin.table-heading>

<x-admin.table-heading>

Room

</x-admin.table-heading>

<x-admin.table-heading class="text-center">

Capacity

</x-admin.table-heading>

<x-admin.table-heading class="text-center">

Occupied

</x-admin.table-heading>

<x-admin.table-heading class="text-center">

Available

</x-admin.table-heading>

<x-admin.table-heading class="text-right">

Price

</x-admin.table-heading>

<x-admin.table-heading class="text-center">

Status

</x-admin.table-heading>

<x-admin.table-heading class="text-center">

Actions

</x-admin.table-heading>

</tr>

</thead>

<tbody>

@forelse($rooms as $room)

<tr class="border-b border-slate-100 hover:bg-slate-50 transition">

<x-admin.table-cell>

<div class="flex items-center gap-3">

<div class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center">

<i class="bi bi-building"></i>

</div>

<div>

<p class="font-medium text-slate-800">

{{ $room->hostel->name }}

</p>

<p class="text-xs text-slate-500">

Hostel Block

</p>

</div>

</div>

</x-admin.table-cell>

<x-admin.table-cell>

{{ $room->room_number }}

</x-admin.table-cell>

<x-admin.table-cell class="text-center">

    <x-admin.badge
        type="info"
        text="{{ $room->capacity }} Beds"/>

</x-admin.table-cell>

<x-admin.table-cell class="text-center">

    <x-admin.badge
        type="warning"
        text="{{ $room->occupied }} Occupied"/>

</x-admin.table-cell>

<x-admin.table-cell class="text-center">

@if($room->availableBeds() > 0)

    <x-admin.badge
        type="success"
        text="{{ $room->availableBeds() }} Free"/>

@else

    <x-admin.badge
        type="danger"
        text="Full"/>

@endif

</x-admin.table-cell>

<x-admin.table-cell class="text-right font-medium">

KES {{ number_format($room->price,2) }}

</x-admin.table-cell>

<x-admin.table-cell class="text-center">

@if($room->status)

    <x-admin.badge
        type="success"
        text="Active"/>

@else

    <x-admin.badge
        type="danger"
        text="Inactive"/>

@endif

</x-admin.table-cell>

<x-admin.table-cell class="text-center">

<div class="flex items-center justify-center gap-2">

    <x-admin.action-button
        href="{{ route('rooms.edit',$room) }}"
        color="blue"
        icon="bi-pencil-square"/>

    <form
        action="{{ route('rooms.destroy',$room) }}"
        method="POST"
        onsubmit="return confirm('Delete this room?')">

        @csrf
        @method('DELETE')

        <x-admin.action-button
            type="submit"
            color="red"
            icon="bi-trash"/>

    </form>

</div>

</x-admin.table-cell>

</tr>

@empty

<tr>

<td colspan="8">

<x-admin.empty-state
    icon="bi-door-open"
    title="No Rooms Found"
    message="Click 'Add Room' to create your first room."/>

</td>

</tr>

@endforelse

</tbody>

</table>

<div class="mt-5 border-t border-slate-200 pt-4">

    {{ $rooms->links() }}

</div>

</x-admin.table>

@endsection