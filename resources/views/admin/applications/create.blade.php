@extends('layouts.admin')

@section('content')

<div class="bg-white p-6 rounded-xl shadow">

    <h2 class="text-2xl font-bold mb-6">
        New Application
    </h2>

    <form action="{{ route('applications.store') }}"
          method="POST">

        @csrf

        <div class="mb-4">

            <label>Student</label>

            <select
                name="student_id"
                class="w-full border p-3 rounded">

                @foreach($students as $student)

                <option value="{{ $student->id }}">
                    {{ $student->registration_number }}
                    -
                    {{ $student->user->name }}
                </option>

                @endforeach

            </select>

        </div>

        <div class="mb-4">

            <label>Hostel</label>

            <select
                name="hostel_id"
                class="w-full border p-3 rounded">

                @foreach($hostels as $hostel)

                <option value="{{ $hostel->id }}">
                    {{ $hostel->name }}
                </option>

                @endforeach

            </select>

        </div>

        <button
            class="bg-blue-600 text-white px-6 py-3 rounded">

            Submit Application

        </button>

    </form>

</div>

@endsection