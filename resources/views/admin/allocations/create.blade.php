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
                    id="student_id"
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
                                data-hostel="{{ $application->hostel->name }}"
                                {{ old('student_id') == $student->id ? 'selected' : '' }}>

                                {{ $student->user->name }}
                                ({{ $student->registration_number }})
                                — {{ $application->hostel->name }}

                            </option>

                        @endif

                    @endforeach

                </x-admin.select>

                <p class="mt-2 text-xs text-slate-500">

                    Only students with approved applications are shown.

                </p>

            </div>

            {{-- Room --}}
            <div>

                <x-admin.select
                    label="Room"
                    name="room_id"
                    id="room_id"
                    required>

                    <option value="">Select Student First</option>

                </x-admin.select>

                <p
                    id="roomHelp"
                    class="mt-2 text-xs text-slate-500">

                    Select a student to load rooms from the approved hostel.

                </p>

            </div>

        </div>

                <x-admin.form-actions
            :cancel="route('allocations.index')"
            submit="Allocate Room" />

    </x-admin.form-card>

</form>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const studentSelect = document.getElementById('student_id');

    const roomSelect = document.getElementById('room_id');

    const roomHelp = document.getElementById('roomHelp');

    studentSelect.addEventListener('change', function () {

        const studentId = this.value;

        roomSelect.innerHTML =
            '<option value="">Loading rooms...</option>';

        roomSelect.disabled = true;

        if (!studentId) {

            roomSelect.innerHTML =
                '<option value="">Select Student First</option>';

            roomHelp.innerHTML =
                'Select a student to load rooms from the approved hostel.';

            return;

        }

        fetch('/allocations/student/' + studentId + '/rooms')

            .then(response => response.json())

            .then(function (rooms) {

                roomSelect.innerHTML =
                    '<option value="">Select Room</option>';

                if (rooms.length === 0) {

                    roomSelect.innerHTML =
                        '<option value="">No rooms available</option>';

                    roomHelp.innerHTML =
                        'No available rooms exist in the approved hostel.';

                    return;

                }

                rooms.forEach(function (room) {

                    let freeBeds = room.capacity - room.occupied;

                    roomSelect.innerHTML +=
                        `<option value="${room.id}">
                            Room ${room.room_number}
                            (${freeBeds} Free Beds)
                        </option>`;

                });

                roomHelp.innerHTML =
                    'Only rooms from the approved hostel are displayed.';

                roomSelect.disabled = false;

            })

            .catch(function () {

                roomSelect.innerHTML =
                    '<option value="">Unable to load rooms</option>';

                roomHelp.innerHTML =
                    'Failed to load rooms.';

            });

    });

});

</script>

@endsection