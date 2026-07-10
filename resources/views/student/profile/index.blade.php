@extends('student.layouts.app')

@section('title','My Profile')

@section('student-content')

<x-student.page-header
    title="My Profile"
    subtitle="View your personal and hostel information."/>

<div class="grid lg:grid-cols-3 gap-6">

    {{-- Left Profile Card --}}
    <div>

        <x-student.card>

            <div class="text-center">

                <form
    action="{{ route('student.profile.photo') }}"
    method="POST"
    enctype="multipart/form-data">

    @csrf

    @if($student?->profile_photo)

        <img
            src="{{ asset('storage/'.$student->profile_photo) }}"
            class="w-32 h-32 rounded-full mx-auto object-cover border-4 border-indigo-100">

    @else

        <div class="w-32 h-32 rounded-full bg-indigo-100 flex items-center justify-center mx-auto">

            <i class="bi bi-person text-6xl text-indigo-600"></i>

        </div>

    @endif

    <input
        type="file"
        name="profile_photo"
        class="mt-4 w-full text-sm"
        accept="image/*"
        required>

    <button
        class="mt-4 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg w-full">

        Update Photo

    </button>

</form>

                <h2 class="text-xl font-bold mt-4">
                    {{ $student->user->name }}
                </h2>

                <p class="text-gray-500">
                    {{ $student->registration_number }}
                </p>

                <div class="mt-4">

                    @if($student->allocation)

                        <x-student.badge
                            type="green"
                            text="Hostel Allocated"/>

                    @else

                        <x-student.badge
                            type="yellow"
                            text="Not Allocated"/>

                    @endif

                </div>

            </div>

        </x-student.card>

    </div>

    {{-- Right Information --}}
    <div class="lg:col-span-2 space-y-6">

        {{-- Personal Information --}}
        <x-student.card>

            <h3 class="text-lg font-semibold mb-6">
                Personal Information
            </h3>

            <div class="grid md:grid-cols-2 gap-6">

                <div>
                    <p class="text-sm text-gray-500">Full Name</p>
                    <h4 class="font-semibold">
                        {{ $student->user->name }}
                    </h4>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Email</p>
                    <h4 class="font-semibold">
                        {{ $student->user->email }}
                    </h4>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Registration Number</p>
                    <h4 class="font-semibold">
                        {{ $student->registration_number }}
                    </h4>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Phone</p>
                    <h4 class="font-semibold">
                        {{ $student->phone ?? '-' }}
                    </h4>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Gender</p>
                    <h4 class="font-semibold">
                        {{ $student->gender ?? '-' }}
                    </h4>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Department</p>
                    <h4 class="font-semibold">
                        {{ $student->department ?? '-' }}
                    </h4>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Year of Study</p>
                    <h4 class="font-semibold">
                        {{ $student->year_of_study ?? '-' }}
                    </h4>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Address</p>
                    <h4 class="font-semibold">
                        {{ $student->address ?? '-' }}
                    </h4>
                </div>

            </div>

        </x-student.card>

        {{-- Guardian Information --}}
        <x-student.card>

            <h3 class="text-lg font-semibold mb-6">
                Guardian Information
            </h3>

            <div class="grid md:grid-cols-2 gap-6">

                <div>

                    <p class="text-sm text-gray-500">
                        Guardian Name
                    </p>

                    <h4 class="font-semibold">
                        {{ $student->guardian_name ?? '-' }}
                    </h4>

                </div>

                <div>

                    <p class="text-sm text-gray-500">
                        Guardian Phone
                    </p>

                    <h4 class="font-semibold">
                        {{ $student->guardian_phone ?? '-' }}
                    </h4>

                </div>

            </div>

        </x-student.card>

        {{-- Hostel Information --}}
        <x-student.card>

            <h3 class="text-lg font-semibold mb-6">
                Hostel Information
            </h3>

            @if($student->allocation)

                <div class="grid md:grid-cols-2 gap-6">

                    <div>

                        <p class="text-sm text-gray-500">
                            Hostel
                        </p>

                        <h4 class="font-semibold">
                            {{ $student->allocation->room->hostel->name }}
                        </h4>

                    </div>

                    <div>

                        <p class="text-sm text-gray-500">
                            Room
                        </p>

                        <h4 class="font-semibold">
                            {{ $student->allocation->room->room_number }}
                        </h4>

                    </div>

                    <div>

                        <p class="text-sm text-gray-500">
                            Floor
                        </p>

                        <h4 class="font-semibold">
                            {{ $student->allocation->room->floor }}
                        </h4>

                    </div>

                    <div>

                        <p class="text-sm text-gray-500">
                            Capacity
                        </p>

                        <h4 class="font-semibold">
                            {{ $student->allocation->room->capacity }}
                        </h4>

                    </div>

                    <div>

                        <p class="text-sm text-gray-500">
                            Allocation Status
                        </p>

                        <h4 class="font-semibold">
                            {{ $student->allocation->status }}
                        </h4>

                    </div>

                </div>

            @else

                <div class="text-center py-10">

                    <i class="bi bi-house-x text-5xl text-gray-300"></i>

                    <p class="mt-4 text-gray-500">

                        You have not yet been allocated a hostel room.

                    </p>

                </div>

            @endif

        </x-student.card>

        {{-- Actions --}}
        <x-student.card>

            <div class="flex flex-wrap gap-4">

                <a
                    href="{{ route('student.settings') }}"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg">

                    Edit Profile

                </a>

                <a
                    href="{{ route('student.settings') }}"
                    class="border border-gray-300 px-6 py-3 rounded-lg hover:bg-gray-50">

                    Change Password

                </a>

            </div>

        </x-student.card>

    </div>

</div>

@endsection