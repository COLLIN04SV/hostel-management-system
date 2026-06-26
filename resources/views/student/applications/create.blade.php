@extends('student.layouts.app')

@section('title', 'Apply Hostel')

@section('student-content')

<div class="bg-white p-6 rounded-lg shadow">

    <h2 class="text-2xl font-bold mb-6">
        Hostel Application
    </h2>

    <form method="POST"
          action="{{ route('student.application.store') }}">

        @csrf

        <div class="mb-4">

            <label class="block mb-2">
                Select Hostel
            </label>

            <select
                name="hostel_id"
                class="w-full border rounded-lg p-3">

                @foreach($hostels as $hostel)

                    <option value="{{ $hostel->id }}">
                        {{ $hostel->name }}
                    </option>

                @endforeach

            </select>

        </div>

        <button
            type="submit"
            class="bg-indigo-600 text-white px-6 py-3 rounded">

            Submit Application

        </button>

    </form>

</div>

@endsection