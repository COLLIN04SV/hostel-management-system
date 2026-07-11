@extends('layouts.admin')

@section('page-title','Allocate Room')

@section('content')

<x-admin.page-header
    title="Allocate Room"
    subtitle="Assign approved students to available rooms">

</x-admin.page-header>

<form
    method="POST"
    action="{{ route('allocations.store') }}">

    @csrf

    <x-admin.form-card>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            {{-- Student --}}
            <div>

                <x-admin.select
                    label="Student"
                    name="student_id"
                    required>

                    <option value="">Select Student</option>

                    @foreach($students as $student)

                        @php
                            $application = $student->applications
                                ->where('status','Approved')
                                ->sortByDesc('created_at')
                                ->first();
                        @endphp

                        @if($application)

                            <option
                                value="{{ $student->id }}"
                                {{ old('student_id') == $student->id ? 'selected' : '' }}>

                                {{ $student->user->name }}
                                ({{ $student->registration_number }})
                                — {{ $application->hostel->name }}

                            </option>

                        @endif

                    @endforeach

                </x-admin.select>

                <p class="mt-2 text-xs text-slate-500">

                    Only students with approved hostel applications are shown.

                </p>

            </div>

            {{-- Room --}}
            <div>

                <x-admin.select
                    label="Room"
                    name="room_id"
                    required>

                    <option value="">Select Room</option>

                    @foreach($rooms as $room)

                        <option
                            value="{{ $room->id }}"
                            {{ old('room_id') == $room->id ? 'selected' : '' }}>

                            {{ $room->hostel->name }}
                            —
                            Room {{ $room->room_number }}
                            ({{ $room->capacity - $room->occupied }} Free)

                        </option>

                    @endforeach

                </x-admin.select>

                <p class="mt-2 text-xs text-slate-500">

                    Only rooms with available beds are listed.

                </p>

            </div>

        </div>

        <x-admin.form-actions
            :cancel="route('allocations.index')"
            submit="Allocate Room" />

    </x-admin.form-card>

</form>

@endsection