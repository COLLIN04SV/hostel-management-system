@extends('layouts.admin')

@section('content')

<div class="bg-white rounded-lg shadow p-6">

    <h2 class="text-2xl font-bold mb-6">
        Edit Student
    </h2>

    <form action="{{ route('students.update', $student->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="mb-4">
            <label>Phone</label>
            <input type="text"
                   name="phone"
                   value="{{ $student->phone }}"
                   class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label>Department</label>
            <input type="text"
                   name="department"
                   value="{{ $student->department }}"
                   class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label>Year of Study</label>
            <input type="text"
                   name="year_of_study"
                   value="{{ $student->year_of_study }}"
                   class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label>Guardian Name</label>
            <input type="text"
                   name="guardian_name"
                   value="{{ $student->guardian_name }}"
                   class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label>Guardian Phone</label>
            <input type="text"
                   name="guardian_phone"
                   value="{{ $student->guardian_phone }}"
                   class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label>Address</label>
            <textarea name="address"
                      class="w-full border rounded p-2">{{ $student->address }}</textarea>
        </div>

        <button
            type="submit"
            class="bg-green-600 text-white px-6 py-2 rounded">

            Update Student
        </button>

    </form>

</div>

@endsection