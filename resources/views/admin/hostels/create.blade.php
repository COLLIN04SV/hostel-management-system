@extends('layouts.admin')

@section('page-title', 'Add Hostel')

@section('content')

<x-admin.page-header
    title="Add Hostel"
    subtitle="Create a new hostel block">

</x-admin.page-header>

<form
    method="POST"
    action="{{ route('hostels.store') }}">

    @csrf

    <x-admin.form-card>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            <x-admin.input
                label="Hostel Name"
                name="name"
                required
                placeholder="e.g. Block A" />

            <x-admin.select
                label="Gender"
                name="gender"
                required>

                <option value="">Select Gender</option>

                <option value="Male"
                    {{ old('gender') == 'Male' ? 'selected' : '' }}>

                    Male

                </option>

                <option value="Female"
                    {{ old('gender') == 'Female' ? 'selected' : '' }}>

                    Female

                </option>

            </x-admin.select>

            <x-admin.input
                label="Capacity"
                name="capacity"
                type="number"
                required
                placeholder="Enter hostel capacity" />

            <x-admin.input
                label="Location"
                name="location"
                placeholder="e.g. East Wing" />

        </div>

        <div class="mt-5">

            <x-admin.textarea
                label="Description"
                name="description"
                rows="4"
                placeholder="Enter hostel description..." />

        </div>

        <x-admin.form-actions
            :cancel="route('hostels.index')"
            submit="Save Hostel" />

    </x-admin.form-card>

</form>

@endsection