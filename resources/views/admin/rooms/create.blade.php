@extends('layouts.admin')

@section('page-title', 'Add Room')

@section('content')

<x-admin.page-header
    title="Add Room"
    subtitle="Create a new hostel room">

</x-admin.page-header>

<form
    method="POST"
    action="{{ route('rooms.store') }}">

    @csrf

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
                        {{ old('hostel_id') == $hostel->id ? 'selected' : '' }}>

                        {{ $hostel->name }}

                    </option>

                @endforeach

            </x-admin.select>

            {{-- Room Number --}}

            <x-admin.input
                label="Room Number"
                name="room_number"
                required
                placeholder="e.g. A101" />

            {{-- Floor --}}

            <x-admin.input
                label="Floor"
                name="floor"
                type="number"
                :value="old('floor',1)"
                required />

            {{-- Capacity --}}

            <x-admin.input
                label="Capacity"
                name="capacity"
                type="number"
                required
                placeholder="Number of beds" />

            {{-- Price --}}

            <x-admin.input
                label="Room Price (KES)"
                name="price"
                type="number"
                step="0.01"
                required
                placeholder="0.00" />

        </div>

        <x-admin.form-actions
            :cancel="route('rooms.index')"
            submit="Save Room" />

    </x-admin.form-card>

</form>

@endsection