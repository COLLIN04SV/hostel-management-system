@extends('layouts.admin')

@section('page-title','Allocate Room')

@section('content')

<x-admin.page-header
    title="Allocate Room"
    subtitle="Assign approved students to available rooms"/>

<x-admin.card>

<form
    method="POST"
    action="{{ route('allocations.store') }}">

@csrf

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <div>

        <label class="block mb-2 font-semibold">

            Student

        </label>

        <select
            name="student_id"
            class="w-full border rounded-xl px-4 py-3"
            required>

            <option value="">

                Select Student

            </option>

@foreach($students as $student)

    @php
        $application = $student->applications
            ->where('status','Approved')
            ->sortByDesc('created_at')
            ->first();
    @endphp

    @if($application)

        <option value="{{ $student->id }}">

            {{ $student->user->name }}
            ({{ $student->registration_number }})
            - {{ $application->hostel->name }}

        </option>

    @endif

@endforeach

</select>

<p class="text-sm text-gray-500 mt-2">

    Only students with approved hostel applications are listed.

</p>

</div>

<div>

    <label class="block mb-2 font-semibold">

        Room

    </label>

    <select
        name="room_id"
        class="w-full border rounded-xl px-4 py-3"
        required>

        <option value="">

            Select Room

        </option>

        @foreach($rooms as $room)

            <option value="{{ $room->id }}">

                {{ $room->hostel->name }}
                -
                Room {{ $room->room_number }}
                ({{ $room->capacity - $room->occupied }}
                Free)

            </option>

        @endforeach

    </select>

    <p class="text-sm text-gray-500 mt-2">

        Only rooms with available beds are displayed.

    </p>

</div>

</div>

<div class="mt-8 flex justify-end gap-3">

    <a
        href="{{ route('allocations.index') }}">

        <x-admin.button color="gray">

            Cancel

        </x-admin.button>

    </a>

    <x-admin.button
        color="blue"
        type="submit">

        <i class="bi bi-house-check mr-2"></i>

        Allocate Room

    </x-admin.button>

</div>

</form>

</x-admin.card>

@endsection          