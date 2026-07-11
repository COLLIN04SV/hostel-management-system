@extends('layouts.admin')

@section('page-title', 'Edit Room')

@section('content')

<x-admin.page-header
    title="Edit Room"
    subtitle="Update room information">

</x-admin.page-header>

<form
    method="POST"
    action="{{ route('rooms.update', $room) }}">

    @csrf
    @method('PUT')

    <x-admin.form-card>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            {{-- Hostel --}}
            <x-admin.select
                label="Hostel"
                name="hostel_id"
                required>

                <option value="">Select Hostel</option>

                @foreach($hostels as $hostel)

                    <option
                        value="{{ $hostel->id }}"
                        {{ old('hostel_id', $room->hostel_id) == $hostel->id ? 'selected' : '' }}>

                        {{ $hostel->name }}

                    </option>

                @endforeach

            </x-admin.select>

            {{-- Room Number --}}
            <x-admin.input
                label="Room Number"
                name="room_number"
                :value="$room->room_number"
                required
                placeholder="e.g. A101" />

            {{-- Floor --}}
            <x-admin.input
                label="Floor"
                name="floor"
                type="number"
                :value="$room->floor"
                required />

            {{-- Capacity --}}
            <x-admin.input
                label="Capacity"
                name="capacity"
                type="number"
                :value="$room->capacity"
                required />

            {{-- Price --}}
            <x-admin.input
                label="Room Price (KES)"
                name="price"
                type="number"
                step="0.01"
                :value="$room->price"
                required />

            {{-- Status --}}
            <x-admin.select
                label="Status"
                name="status"
                required>

                <option
                    value="1"
                    {{ old('status', $room->status) == 1 ? 'selected' : '' }}>

                    Active

                </option>

                <option
                    value="0"
                    {{ old('status', $room->status) == 0 ? 'selected' : '' }}>

                    Inactive

                </option>

            </x-admin.select>

        </div>

        <x-admin.form-actions
            :cancel="route('rooms.index')"
            submit="Update Room" />

    </x-admin.form-card>

</form>

@endsection