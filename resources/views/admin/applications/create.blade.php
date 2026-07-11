@extends('layouts.admin')

@section('page-title', 'New Application')

@section('content')

<x-admin.page-header
    title="New Application"
    subtitle="Submit a hostel application for a student">

</x-admin.page-header>

<form
    action="{{ route('applications.store') }}"
    method="POST">

    @csrf

    <x-admin.form-card>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            {{-- Student --}}
            <x-admin.select
                label="Student"
                name="student_id"
                required>

                <option value="">Select Student</option>

                @foreach($students as $student)

                    <option
                        value="{{ $student->id }}"
                        {{ old('student_id') == $student->id ? 'selected' : '' }}>

                        {{ $student->registration_number }}
                        -
                        {{ $student->user->name }}

                    </option>

                @endforeach

            </x-admin.select>

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

        </div>

        <x-admin.form-actions
            :cancel="route('applications.index')"
            submit="Submit Application" />

    </x-admin.form-card>

</form>

@endsection