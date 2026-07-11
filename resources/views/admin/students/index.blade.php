@extends('layouts.admin')

@section('title', 'Students')

@section('page-title', 'Students')

@section('page-description', 'Manage all registered students')

@section('content')

<x-admin.page-header
    title="Students"
    subtitle="Manage all registered students">

    <x-admin.button href="{{ route('students.create') }}">
        <i class="bi bi-plus-lg mr-2"></i>
        Add Student
    </x-admin.button>

</x-admin.page-header>

@if(session('success'))

<div class="mb-5 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-700">

    <i class="bi bi-check-circle-fill mr-2"></i>

    {{ session('success') }}

</div>

@endif

@if(session('error'))

<div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-700">

    <i class="bi bi-exclamation-circle-fill mr-2"></i>

    {{ session('error') }}

</div>

@endif

<x-admin.stats-grid>

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

</x-admin.stats-grid>

<x-admin.table>

<x-admin.search-bar
    :action="route('students.index')"
    placeholder="Search student, registration number or department..." />

<div class="flex items-center justify-between mb-5">

    <p class="text-sm text-slate-500">

        Showing

        <strong>{{ $students->firstItem() ?? 0 }}</strong>

        -

        <strong>{{ $students->lastItem() ?? 0 }}</strong>

        of

        <strong>{{ $students->total() }}</strong>

        students

    </p>

</div>

<table class="min-w-full">

<thead class="bg-slate-50 border-b">

<tr>

<x-admin.table-heading class="w-14">

#

</x-admin.table-heading>

<x-admin.table-heading>

Student

</x-admin.table-heading>

<x-admin.table-heading>

Registration

</x-admin.table-heading>

<x-admin.table-heading>

Department

</x-admin.table-heading>

<x-admin.table-heading>

Hostel

</x-admin.table-heading>

<x-admin.table-heading>

Room

</x-admin.table-heading>

<x-admin.table-heading class="text-center">

Status

</x-admin.table-heading>

<x-admin.table-heading class="text-center">

Actions

</x-admin.table-heading>

</tr>

</thead>

<tbody>

@forelse($students as $student)

@php
$number = ($students->currentPage()-1) * $students->perPage() + $loop->iteration;
@endphp

<tr class="border-b border-slate-100 hover:bg-slate-50 transition">

<x-admin.table-cell>

{{ $number }}

</x-admin.table-cell>

<x-admin.table-cell>

<div class="flex items-center gap-3">

@if($student->profile_photo)

<img
    src="{{ asset('storage/'.$student->profile_photo) }}"
    class="w-10 h-10 rounded-full object-cover">

@else

<div class="w-10 h-10 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-semibold">

{{ strtoupper(substr($student->user->name,0,1)) }}

</div>

@endif

<div>

<p class="font-medium text-slate-800">

{{ $student->user->name }}

</p>

<p class="text-xs text-slate-500">

{{ $student->user->email }}

</p>

</div>

</div>

</x-admin.table-cell>

<x-admin.table-cell>

    {{ $student->registration_number }}

</x-admin.table-cell>

<x-admin.table-cell>

    {{ $student->department ?? '-' }}

</x-admin.table-cell>

<x-admin.table-cell>

    {{ optional($student->allocation?->room?->hostel)->name ?? '-' }}

</x-admin.table-cell>

<x-admin.table-cell>

    {{ optional($student->allocation?->room)->room_number ?? '-' }}

</x-admin.table-cell>

<x-admin.table-cell class="text-center">

@if($student->allocation)

    <x-admin.badge
        type="success"
        text="Allocated"/>

@else

    <x-admin.badge
        type="warning"
        text="Pending"/>

@endif

</x-admin.table-cell>

<x-admin.table-cell class="text-center">

<div class="flex items-center justify-center gap-2">

    <x-admin.action-button
        href="{{ route('students.show',$student) }}"
        color="green"
        icon="bi-eye"/>

    <x-admin.action-button
        href="{{ route('students.edit',$student) }}"
        color="blue"
        icon="bi-pencil-square"/>

    <form
        action="{{ route('students.destroy',$student) }}"
        method="POST"
        onsubmit="return confirm('Delete this student?')">

        @csrf
        @method('DELETE')

        <x-admin.action-button
            type="submit"
            color="red"
            icon="bi-trash"/>

    </form>

</div>

</x-admin.table-cell>

</tr>

@empty

<tr>

<td colspan="8" class="py-16">

<x-admin.empty-state
    icon="bi-people"
    title="No Students Found"
    message="Try changing your search or add a new student."/>

</td>

</tr>

@endforelse

</tbody>

</table>

<div class="mt-5 border-t border-slate-200 pt-4">

    {{ $students->links() }}

</div>

</x-admin.table>

@endsection