@extends('layouts.admin')

@section('page-title', 'Add Student')

@section('content')

<x-admin.page-header
    title="Add Student"
    subtitle="Register a new hostel student">

</x-admin.page-header>

<form
    method="POST"
    action="{{ route('students.store') }}"
    enctype="multipart/form-data">

    @csrf

    <x-admin.form-card>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            <x-admin.input
                label="Full Name"
                name="name"
                required
                placeholder="Enter student's full name" />

            <x-admin.input
                label="Email Address"
                name="email"
                type="email"
                required
                placeholder="student@example.com" />

            <x-admin.input
                label="Password"
                name="password"
                type="password"
                required
                placeholder="Enter password" />

            <x-admin.input
                label="Registration Number"
                name="registration_number"
                required
                placeholder="e.g CST001" />

            <x-admin.select
                label="Gender"
                name="gender"
                required>

                <option value="">Select Gender</option>

                <option value="Male"
                    {{ old('gender')=='Male' ? 'selected' : '' }}>
                    Male
                </option>

                <option value="Female"
                    {{ old('gender')=='Female' ? 'selected' : '' }}>
                    Female
                </option>

            </x-admin.select>

            <x-admin.input
                label="Phone Number"
                name="phone"
                placeholder="07XXXXXXXX" />

            <x-admin.input
                label="Department"
                name="department"
                placeholder="Computer Science" />

            <x-admin.input
                label="Year of Study"
                name="year_of_study"
                placeholder="Year 1 - Year 4" />

            <x-admin.input
                label="Guardian Name"
                name="guardian_name"
                placeholder="Guardian's full name" />

            <x-admin.input
                label="Guardian Phone"
                name="guardian_phone"
                placeholder="07XXXXXXXX" />

        </div>

        <div class="mt-5">

            <x-admin.textarea
                label="Address"
                name="address"
                rows="3"
                placeholder="Student's home address" />

        </div>

        <div class="mt-5">

            <label class="block text-sm font-medium text-slate-700 mb-2">

                Profile Photo

            </label>

            <input
                type="file"
                name="profile_photo"
                class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm
                       file:mr-4 file:rounded-md file:border-0
                       file:bg-blue-50 file:px-4 file:py-2
                       file:text-blue-600 hover:file:bg-blue-100">

            @error('profile_photo')

                <p class="mt-1 text-sm text-red-500">

                    {{ $message }}

                </p>

            @enderror

        </div>

        <x-admin.form-actions
            :cancel="route('students.index')"
            submit="Save Student" />

    </x-admin.form-card>

</form>

@endsection