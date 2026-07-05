@extends('layouts.admin')

@section('page-title', 'Students')

@section('content')

<x-admin.page-header
    title="Students"
    subtitle="Manage all registered students">

    <x-admin.button
    href="{{ route('students.create') }}">
        <i class="bi bi-plus-lg mr-2"></i>
        Add Student
    </x-admin.button>

</x-admin.page-header>

{{-- Flash Message --}}
@if(session('success'))

<div class="mb-6 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl">

    {{ session('success') }}

</div>

@endif

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-6">

    <x-admin.stat-card
        title="Total Students"
        :value="$totalStudents"
        icon="bi-people"
        color="blue"/>

    <x-admin.stat-card
        title="Male Students"
        :value="$totalMale"
        icon="bi-gender-male"
        color="green"/>

    <x-admin.stat-card
        title="Female Students"
        :value="$totalFemale"
        icon="bi-gender-female"
        color="red"/>

    <x-admin.stat-card
        title="Allocated"
        :value="$totalAllocated"
        icon="bi-house-check"
        color="yellow"/>

</div>

<x-admin.card>

    {{-- Search --}}

    <form
    method="GET"
    action="{{ route('students.index') }}"
    class="mb-6 flex gap-3">

    <div class="relative flex-1">

        <i class="bi bi-search absolute left-4 top-4 text-gray-400"></i>

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search student, registration number or department..."

            class="w-full pl-12 pr-4 py-3 border rounded-xl focus:ring-2 focus:ring-blue-500">

    </div>

    <button
        class="bg-blue-600 hover:bg-blue-700 text-white px-6 rounded-xl">

        Search

    </button>

    @if(request('search'))

        <a
            href="{{ route('students.index') }}"
            class="bg-gray-200 hover:bg-gray-300 px-5 rounded-xl flex items-center">

            Clear

        </a>

    @endif

</form>

<div class="flex justify-between items-center mb-4">

    <p class="text-gray-500">

        Showing

        <strong>

            {{ $students->firstItem() ?? 0 }}

        </strong>

        -

        <strong>

            {{ $students->lastItem() ?? 0 }}

        </strong>

        of

        <strong>

            {{ $students->total() }}

        </strong>

        students

    </p>

</div>

    <div class="overflow-x-auto">

        <table class="w-full">

            <thead>

<tr class="border-b hover:bg-blue-50 transition duration-200">

    <th class="p-4 w-12">

        #

    </th>

    <th class="p-4 text-left">

        Student

    </th>

    <th class="p-4 text-left">

        Registration

    </th>

    <th class="p-4 text-left">

        Department

    </th>

    <th class="p-4 text-left">

        Hostel

    </th>

    <th class="p-4 text-left">

        Room

    </th>

    <th class="p-4 text-center">

        Status

    </th>

    <th class="p-4 text-center">

        Actions

    </th>

</tr>

</thead>

            <tbody>

            @forelse($students as $student)

            @php

            $number = ($students->currentPage()-1)*$students->perPage()+$loop->iteration;

            @endphp

                <tr class="border-b hover:bg-gray-50">

                    {{-- Student --}}

                    <td class="p-4 text-gray-500 font-medium">

    {{ $number }}

</td>

<td class="p-4">

    <div class="flex items-center gap-3">

        @if($student->profile_photo)

            <img
                src="{{ asset('storage/'.$student->profile_photo) }}"
                class="w-11 h-11 rounded-full object-cover">

        @else

            <div class="w-11 h-11 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-bold">

                {{ strtoupper(substr($student->user->name,0,1)) }}

            </div>

        @endif

        <div>

            <p class="font-semibold">

                {{ $student->user->name }}

            </p>

            <p class="text-sm text-gray-500">

                {{ $student->user->email }}

            </p>

        </div>

    </div>

</td>

                    {{-- Registration --}}

                    <td class="p-4">

                        {{ $student->registration_number }}

                    </td>

                    {{-- Department --}}

                    <td class="p-4">

                        {{ $student->department }}

                    </td>

                    {{-- Hostel --}}

                    <td class="p-4">

                        {{ optional($student->allocation?->room?->hostel)->name ?? '-' }}

                    </td>

                    {{-- Room --}}

                    <td class="p-4">

                        {{ optional($student->allocation?->room)->room_number ?? '-' }}

                    </td>

                    {{-- Status --}}

                    <td class="p-4 text-center">

    @if($student->allocation)

        <x-admin.badge
            type="success"
            text="Allocated" />

    @else

        <x-admin.badge
            type="warning"
            text="Pending" />

    @endif

</td>
                    {{-- Actions --}}

                    <td class="p-4">

    <div class="flex justify-center gap-2">

        <x-admin.action-button
            href="{{ route('students.show',$student) }}"
            color="green"
            icon="bi-eye" />

        <x-admin.action-button
            href="{{ route('students.edit',$student) }}"
            color="blue"
            icon="bi-pencil-square" />

        <form
            method="POST"
            action="{{ route('students.destroy',$student) }}"
            onsubmit="return confirm('Delete this student?')">

            @csrf
            @method('DELETE')

            <x-admin.action-button
                type="submit"
                color="red"
                icon="bi-trash" />

        </form>

    </div>

</td>

                </tr>

            @empty

               <div class="py-12">

    <i class="bi bi-people text-5xl text-gray-300"></i>

    <h3 class="text-xl font-semibold mt-4">

        No Students Found

    </h3>

    <p class="text-gray-500 mt-2">

        Try changing your search or add a new student.

    </p>

</div>

            @endforelse

            </tbody>

        </table>

    </div>

    {{-- Pagination --}}

    <div class="mt-6">

        {{ $students->links() }}

    </div>

</x-admin.card>

@endsection