@extends('layouts.admin')

@section('page-title', 'Edit Student')

@section('content')

<x-admin.page-header
    title="Edit Student"
    subtitle="Update student information">

</x-admin.page-header>

<form
    action="{{ route('students.update', $student->id) }}"
    method="POST">

    @csrf
    @method('PUT')

    <x-admin.form-card>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            <x-admin.input
                label="Phone Number"
                name="phone"
                :value="$student->phone"
                placeholder="07XXXXXXXX" />

            <x-admin.input
                label="Department"
                name="department"
                :value="$student->department"
                placeholder="Computer Science" />

            <x-admin.input
                label="Year of Study"
                name="year_of_study"
                :value="$student->year_of_study"
                placeholder="Year 1 - Year 4" />

            <x-admin.input
                label="Guardian Name"
                name="guardian_name"
                :value="$student->guardian_name"
                placeholder="Guardian's full name" />

            <x-admin.input
                label="Guardian Phone"
                name="guardian_phone"
                :value="$student->guardian_phone"
                placeholder="07XXXXXXXX" />

        </div>

        <div class="mt-5">

            <x-admin.textarea
                label="Address"
                name="address"
                rows="4"
                :value="$student->address"
                placeholder="Student's home address" />

        </div>

        <x-admin.form-actions
            :cancel="route('students.index')"
            submit="Update Student" />

    </x-admin.form-card>

</form>

@endsection