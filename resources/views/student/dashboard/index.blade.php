@extends('student.layouts.app')

@section('title','Dashboard')

@section('student-content')

<x-student.section-title
    title="Student Dashboard"
    subtitle="Welcome back! Here's a summary of your hostel information." />

{{-- Statistics --}}

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

    <x-student.stat-card
        title="Hostel"
        :value="$allocation?->room?->hostel?->name ?? 'Not Allocated'"
        icon="bi-building"
        color="indigo"/>

    <x-student.stat-card
        title="Room"
        :value="$allocation?->room?->room_number ?? 'N/A'"
        icon="bi-door-open"
        color="blue"/>

    <x-student.stat-card
        title="Status"
        :value="$allocation?->status ?? 'Pending'"
        icon="bi-house-check"
        color="green"/>

    <x-student.stat-card
        title="Balance"
        value="KES {{ number_format($balance ?? 0) }}"
        icon="bi-credit-card"
        color="red"/>
    
</div>

<div class="grid lg:grid-cols-3 gap-6">

    {{-- Room Details --}}

    <div class="lg:col-span-2">

        <x-student.card>

            <div class="flex justify-between items-center mb-5">

                <h3 class="font-semibold text-lg">
                    Room Information
                </h3>

                @if($allocation)

                    <x-student.badge
                        type="green"
                        text="Allocated"/>

                @else

                    <x-student.badge
                        type="yellow"
                        text="Waiting"/>

                @endif

            </div>

            @if($allocation)

            <div class="grid grid-cols-2 gap-6">

                <div>

                    <p class="text-gray-500 text-sm">
                        Hostel
                    </p>

                    <h4 class="font-semibold">
                        {{ $allocation->room->hostel->name }}
                    </h4>

                </div>

                <div>

                    <p class="text-gray-500 text-sm">
                        Room Number
                    </p>

                    <h4 class="font-semibold">
                        {{ $allocation->room->room_number }}
                    </h4>

                </div>

                <div>

                    <p class="text-gray-500 text-sm">
                        Floor
                    </p>

                    <h4 class="font-semibold">
                        {{ $allocation->room->floor }}
                    </h4>

                </div>

                <div>

                    <p class="text-gray-500 text-sm">
                        Capacity
                    </p>

                    <h4 class="font-semibold">
                        {{ $allocation->room->capacity }}
                    </h4>

                </div>

                <div>

                    <p class="text-gray-500 text-sm">
                        Occupied
                    </p>

                    <h4 class="font-semibold">
                        {{ $allocation->room->occupied }}
                    </h4>

                </div>

                <div>

                    <p class="text-gray-500 text-sm">
                        Monthly Fee
                    </p>

                    <h4 class="font-semibold">
                        KES {{ number_format($allocation->room->price) }}
                    </h4>

                </div>

            </div>

            @else

            <div class="text-center py-10">

                <i class="bi bi-house-x text-5xl text-gray-300"></i>

                <p class="mt-4 text-gray-500">

                    You have not yet been allocated a room.

                </p>

            </div>

            @endif

        </x-student.card>

    </div>

    {{-- Quick Actions --}}

    <div>

        <x-student.card>

            <h3 class="font-semibold text-lg mb-5">
                Quick Actions
            </h3>

            <div class="space-y-4">

                <x-student.quick-action
                    icon="bi-building-add"
                    title="Apply Hostel"
                    subtitle="Submit hostel application"
                    :route="route('student.application.create')"/>

                <x-student.quick-action
                    icon="bi-file-earmark-text"
                    title="My Applications"
                    subtitle="Track application progress"
                    :route="route('student.applications.index')"/>

                <x-student.quick-action
                    icon="bi-credit-card"
                    title="Payments"
                    subtitle="View payment history"
                    route="#"/>

                <x-student.quick-action
                    icon="bi-megaphone"
                    title="Notices"
                    subtitle="Latest hostel announcements"
                    route="#"/>

            </div>

        </x-student.card>

    </div>

</div>

@endsection