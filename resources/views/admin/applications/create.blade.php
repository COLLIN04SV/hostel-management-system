@extends('layouts.admin')

@section('page-title','New Application')

@section('content')

<x-admin.page-header
    title="New Application"
    subtitle="Submit a hostel application for a student">
</x-admin.page-header>

<form
    action="{{ route('applications.store') }}"
    method="POST">

    @csrf

    <x-admin.form-card>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Student --}}

            <div>

                <label class="block text-sm font-medium text-slate-700 mb-2">

                    Student <span class="text-red-500">*</span>

                </label>

                <select
                    id="student_id"
                    name="student_id"
                    required
                    class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500">

                    <option value="">

                        Select Student

                    </option>

                    @foreach($students as $student)

                        <option
                            value="{{ $student->id }}"
                            {{ old('student_id') == $student->id ? 'selected' : '' }}>

                            {{ $student->registration_number }}
                            -
                            {{ $student->user->name }}

                        </option>

                    @endforeach

                </select>

                @error('student_id')

                    <p class="text-sm text-red-500 mt-2">

                        {{ $message }}

                    </p>

                @enderror

            </div>


            {{-- Hostel --}}

            <div>

                <label class="block text-sm font-medium text-slate-700 mb-2">

                    Hostel <span class="text-red-500">*</span>

                </label>

                <select
                    id="hostel_id"
                    name="hostel_id"
                    required
                    disabled
                    class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500">

                    <option value="">

                        Select student first

                    </option>

                </select>

                @error('hostel_id')

                    <p class="text-sm text-red-500 mt-2">

                        {{ $message }}

                    </p>

                @enderror

            </div>

        </div>

        <x-admin.form-actions
            :cancel="route('applications.index')"
            submit="Submit Application"/>

    </x-admin.form-card>

</form>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const studentSelect = document.getElementById('student_id');
    const hostelSelect = document.getElementById('hostel_id');

    studentSelect.addEventListener('change', function () {

        const studentId = this.value;

        hostelSelect.innerHTML =
            '<option value="">Loading hostels...</option>';

        hostelSelect.disabled = true;

        if (!studentId) {

            hostelSelect.innerHTML =
                '<option value="">Select student first</option>';

            return;

        }

        fetch('/applications/student/' + studentId + '/hostels')

            .then(response => response.json())

            .then(hostels => {

                hostelSelect.innerHTML =
                    '<option value="">Select Hostel</option>';

                if (hostels.length === 0) {

                    hostelSelect.innerHTML =
                        '<option value="">No matching hostels available</option>';

                    return;

                }

                hostels.forEach(function(hostel) {

                    hostelSelect.innerHTML += `

                        <option value="${hostel.id}">

                            ${hostel.name}

                        </option>

                    `;

                });

                hostelSelect.disabled = false;

            })

            .catch(function () {

                hostelSelect.innerHTML =
                    '<option value="">Unable to load hostels</option>';

            });

    });

});

</script>

@endsection