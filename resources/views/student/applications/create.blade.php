@extends('student.layouts.app')

@section('title','Apply Hostel')

@section('student-content')

<x-student.page-header
    title="Apply for Hostel"
    subtitle="Choose a hostel available for {{ $student->gender }} students" />

@if($hostels->isEmpty())

<x-student.card>

    <div class="text-center py-16">

        <i class="bi bi-house-x text-6xl text-gray-300"></i>

        <h3 class="text-xl font-semibold mt-4">

            No Hostels Available

        </h3>

        <p class="text-gray-500 mt-2">

            There are currently no hostels available for your category.

        </p>

    </div>

</x-student.card>

@else

<div class="grid md:grid-cols-2 xl:grid-cols-3 gap-6">

@foreach($hostels as $hostel)

    <x-student.hostel-card
        :hostel="$hostel"/>

@endforeach

</div>

@endif

@endsection