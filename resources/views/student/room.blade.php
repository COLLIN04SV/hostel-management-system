@extends('student.layouts.app')

@section('title','My Room')

@section('student-content')

<div class="space-y-6">

    <div>
        <h1 class="text-3xl font-bold text-gray-800">
            My Room
        </h1>

        <p class="text-gray-500 mt-1">
            View your hostel and room allocation.
        </p>
    </div>

    @if($allocation)

    <div class="grid md:grid-cols-2 gap-6">

        <x-student.info
            title="Hostel"
            :value="$allocation->room->hostel->name"
            icon="bi-building"/>

        <x-student.info
            title="Room Number"
            :value="$allocation->room->room_number"
            icon="bi-door-open"/>

        <x-student.info
            title="Floor"
            :value="$allocation->room->floor"
            icon="bi-layers"/>

        <x-student.info
            title="Capacity"
            :value="$allocation->room->capacity"
            icon="bi-people"/>

        <x-student.info
            title="Occupied"
            :value="$allocation->room->occupied"
            icon="bi-person-check"/>

        <x-student.info
            title="Monthly Fee"
            :value="'KES '.number_format($allocation->room->price)"
            icon="bi-cash-stack"/>

    </div>

    @else

    <div class="bg-white rounded-2xl shadow-sm border p-12 text-center">

        <i class="bi bi-house text-5xl text-gray-300"></i>

        <h2 class="mt-4 text-xl font-semibold">
            No Room Allocated
        </h2>

        <p class="text-gray-500 mt-2">
            You have not yet been allocated a hostel room.
        </p>

    </div>

    @endif

</div>

@endsection