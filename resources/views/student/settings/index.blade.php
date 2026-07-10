@extends('student.layouts.app')

@section('title','Settings')

@section('student-content')

<x-student.section-title
    title="Settings"
    subtitle="Manage your personal information."/>

@if(session('success'))

<div class="mb-6 bg-green-100 border border-green-300 text-green-700 p-4 rounded-xl">

    {{ session('success') }}

</div>

@endif

<x-student.card>

<form
    method="POST"
    action="{{ route('student.settings.update') }}">

    @csrf

    <div class="grid md:grid-cols-2 gap-6">

        <div>

            <label class="font-medium">

                Full Name

            </label>

            <input
                class="w-full border rounded-lg p-3 mt-2 bg-gray-100"
                value="{{ $student->user->name }}"
                readonly>

        </div>

        <div>

            <label class="font-medium">

                Registration Number

            </label>

            <input
                class="w-full border rounded-lg p-3 mt-2 bg-gray-100"
                value="{{ $student->registration_number }}"
                readonly>

        </div>

        <div>

            <label class="font-medium">

                Email

            </label>

            <input
                class="w-full border rounded-lg p-3 mt-2 bg-gray-100"
                value="{{ $student->user->email }}"
                readonly>

        </div>

        <div>

            <label class="font-medium">

                Phone Number

            </label>

            <input
                type="text"
                name="phone"
                class="w-full border rounded-lg p-3 mt-2"
                value="{{ old('phone',$student->phone) }}">

        </div>

        <div>

            <label class="font-medium">

                Guardian Name

            </label>

            <input
                type="text"
                name="guardian_name"
                class="w-full border rounded-lg p-3 mt-2"
                value="{{ old('guardian_name',$student->guardian_name) }}">

        </div>

        <div>

            <label class="font-medium">

                Guardian Phone

            </label>

            <input
                type="text"
                name="guardian_phone"
                class="w-full border rounded-lg p-3 mt-2"
                value="{{ old('guardian_phone',$student->guardian_phone) }}">

        </div>

    </div>

    <div class="mt-6">

        <label class="font-medium">

            Address

        </label>

        <textarea
            name="address"
            rows="4"
            class="w-full border rounded-lg p-3 mt-2">{{ old('address',$student->address) }}</textarea>

    </div>

    <div class="mt-8">

        <button
            class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-xl">

            Save Changes

        </button>

    </div>

</form>

</x-student.card>

@endsection