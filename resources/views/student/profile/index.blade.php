@extends('student.layouts.app')

@section('title','My Profile')

@section('student-content')

<div class="space-y-6">

    <div>

        <h2 class="text-3xl font-bold">
            My Profile
        </h2>

        <p class="text-gray-500">
            View your personal and academic information.
        </p>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Profile Card -->

        <div class="bg-white rounded-2xl shadow-sm border p-6">

            <div class="flex flex-col items-center">

                @if($student->profile_photo)

                    <img
                        src="{{ asset('storage/'.$student->profile_photo) }}"
                        class="w-32 h-32 rounded-full object-cover">

                @else

                    <div class="w-32 h-32 rounded-full bg-indigo-100 flex items-center justify-center text-5xl text-indigo-600">

                        <i class="bi bi-person"></i>

                    </div>

                @endif

                <h3 class="mt-4 text-xl font-bold">

                    {{ $student->user->name }}

                </h3>

                <p class="text-gray-500">

                    {{ $student->registration_number }}

                </p>

            </div>

        </div>

        <!-- Details -->

        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border p-6">

            <div class="grid md:grid-cols-2 gap-6">

                <div>
                    <label class="text-gray-500 text-sm">
                        Email
                    </label>

                    <p class="font-semibold">
                        {{ $student->user->email }}
                    </p>
                </div>

                <div>
                    <label class="text-gray-500 text-sm">
                        Phone
                    </label>

                    <p class="font-semibold">
                        {{ $student->phone }}
                    </p>
                </div>

                <div>
                    <label class="text-gray-500 text-sm">
                        Gender
                    </label>

                    <p class="font-semibold">
                        {{ $student->gender }}
                    </p>
                </div>

                <div>
                    <label class="text-gray-500 text-sm">
                        Department
                    </label>

                    <p class="font-semibold">
                        {{ $student->department }}
                    </p>
                </div>

                <div>
                    <label class="text-gray-500 text-sm">
                        Year of Study
                    </label>

                    <p class="font-semibold">
                        {{ $student->year_of_study }}
                    </p>
                </div>

                <div>
                    <label class="text-gray-500 text-sm">
                        Guardian
                    </label>

                    <p class="font-semibold">
                        {{ $student->guardian_name }}
                    </p>
                </div>

                <div>
                    <label class="text-gray-500 text-sm">
                        Guardian Phone
                    </label>

                    <p class="font-semibold">
                        {{ $student->guardian_phone }}
                    </p>
                </div>

                <div class="md:col-span-2">

                    <label class="text-gray-500 text-sm">
                        Address
                    </label>

                    <p class="font-semibold">
                        {{ $student->address }}
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection