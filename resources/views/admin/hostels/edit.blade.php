@extends('layouts.admin')

@section('page-title', 'Edit Hostel')

@section('content')

<x-admin.page-header
    title="Edit Hostel"
    subtitle="Update hostel information">

</x-admin.page-header>

<form
    method="POST"
    action="{{ route('hostels.update', $hostel) }}">

    @csrf
    @method('PUT')

    <x-admin.form-card>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            <x-admin.input
                label="Hostel Name"
                name="name"
                :value="$hostel->name"
                required
                placeholder="e.g. Block A" />

            <x-admin.select
                label="Gender"
                name="gender"
                required>

                <option value="">Select Gender</option>

                <option
                    value="Male"
                    {{ old('gender', $hostel->gender) == 'Male' ? 'selected' : '' }}>

                    Male

                </option>

                <option
                    value="Female"
                    {{ old('gender', $hostel->gender) == 'Female' ? 'selected' : '' }}>

                    Female

                </option>

            </x-admin.select>

            <x-admin.input
                label="Capacity"
                name="capacity"
                type="number"
                :value="$hostel->capacity"
                required
                placeholder="Enter hostel capacity" />

            <x-admin.input
                label="Location"
                name="location"
                :value="$hostel->location"
                placeholder="e.g. East Wing" />

        </div>

        <div class="mt-5">

            <x-admin.textarea
                label="Description"
                name="description"
                rows="4"
                :value="$hostel->description"
                placeholder="Enter hostel description..." />

        </div>

        <x-admin.form-actions
            :cancel="route('hostels.index')"
            submit="Update Hostel" />

    </x-admin.form-card>

</form>

@endsection