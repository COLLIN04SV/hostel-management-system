@extends('layouts.admin')

@section('content')

<div class="bg-white rounded-lg shadow p-6">

    <h2 class="text-2xl font-bold mb-6">
        Student Profile
         @if($student->profile_photo)

         <img
          src="{{ asset('storage/' . $student->profile_photo) }}"
          alt="Student Photo"
          class="w-32 h-32 rounded-full object-cover mb-4">

         @endif
    </h2>

    <div class="grid grid-cols-2 gap-6">

        <div>
            <h3 class="font-bold mb-3">Student Information</h3>

            <p><strong>Reg No:</strong> {{ $student->registration_number }}</p>
            <p><strong>Phone:</strong> {{ $student->phone }}</p>
            <p><strong>Gender:</strong> {{ $student->gender }}</p>
            <p><strong>Department:</strong> {{ $student->department }}</p>
            <p><strong>Year:</strong> {{ $student->year_of_study }}</p>
        </div>

        <div>
            <h3 class="font-bold mb-3">Guardian Information</h3>

            <p><strong>Name:</strong> {{ $student->guardian_name }}</p>
            <p><strong>Phone:</strong> {{ $student->guardian_phone }}</p>
        </div>

    </div>

</div>

@endsection