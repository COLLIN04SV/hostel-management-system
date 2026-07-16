@extends('layouts.admin')

@section('title','Allocations')

@section('page-title','Allocations')

@section('page-description','Manage student room allocations')

@section('content')

<x-admin.page-header
    title="Room Allocations"
    subtitle="Manage student room allocations">

    <div class="flex gap-3">

        <x-admin.button
            href="{{ route('allocations.create') }}">

            <i class="bi bi-plus-lg mr-2"></i>

            Allocate Student

        </x-admin.button>

        <form
            method="POST"
            action="{{ route('allocations.auto-allocate') }}">

            @csrf

            <button
                class="inline-flex items-center px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-medium transition">

                <i class="bi bi-magic mr-2"></i>

                Auto Allocate Rooms

            </button>

        </form>

    </div>

</x-admin.page-header>

<x-admin.stats-grid>

    <x-admin.stat-card
        title="Total Allocations"
        :value="$totalAllocations"
        icon="bi-house-check"
        color="blue"/>

    <x-admin.stat-card
        title="Occupied Rooms"
        :value="$activeAllocations"
        icon="bi-house-door-fill"
        color="green"/>

    <x-admin.stat-card
        title="Available Rooms"
        :value="$availableRooms"
        icon="bi-door-open"
        color="yellow"/>

    <x-admin.stat-card
        title="Occupancy Rate"
        :value="$availableRooms + $activeAllocations > 0
            ? round(($activeAllocations / ($availableRooms + $activeAllocations))*100).'%'
            : '0%'"
        icon="bi-bar-chart-fill"
        color="indigo"/>

</x-admin.stats-grid>

<x-admin.table>

<x-admin.search-bar
    :action="route('allocations.index')"
    :value="$search"
    placeholder="Search student, registration number, hostel or room..." />

<div class="flex items-center justify-between mb-5">

    <p class="text-sm text-slate-500">

        Showing

        <strong>{{ $allocations->firstItem() ?? 0 }}</strong>

        -

        <strong>{{ $allocations->lastItem() ?? 0 }}</strong>

        of

        <strong>{{ $allocations->total() }}</strong>

        allocations

    </p>

</div>

<table class="min-w-full">

<thead class="bg-slate-50 border-b">

<tr>

<x-admin.table-heading>

Student

</x-admin.table-heading>

<x-admin.table-heading>

Hostel

</x-admin.table-heading>

<x-admin.table-heading>

Room

</x-admin.table-heading>

<x-admin.table-heading>

Allocated

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

@forelse($allocations as $allocation)

<tr class="border-b border-slate-100 hover:bg-slate-50 transition">

    <x-admin.table-cell>

        <div class="flex items-center gap-3">

            <div class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold">

                {{ strtoupper(substr($allocation->student->user->name,0,1)) }}

            </div>

            <div>

                <p class="font-medium text-slate-800">

                    {{ $allocation->student->user->name }}

                </p>

                <p class="text-xs text-slate-500">

                    {{ $allocation->student->registration_number }}

                </p>

            </div>

        </div>

    </x-admin.table-cell>

    <x-admin.table-cell>

        {{ $allocation->room->hostel->name }}

    </x-admin.table-cell>

    <x-admin.table-cell>

        <div class="font-semibold">

            Room {{ $allocation->room->room_number }}

        </div>

        <div class="text-xs text-slate-500">

            Floor {{ $allocation->room->floor }}

        </div>

    </x-admin.table-cell>

    <x-admin.table-cell>

        {{ \Carbon\Carbon::parse($allocation->allocated_date)->format('d M Y') }}

    </x-admin.table-cell>

    <x-admin.table-cell class="text-center">

        <x-admin.badge
            type="success"
            text="Occupied"/>

    </x-admin.table-cell>

    <x-admin.table-cell class="text-center">

        <div class="flex items-center justify-center gap-2">

            <a
                href="{{ route('allocations.change-room',$allocation) }}">

                <x-admin.action-button
                    color="blue"
                    icon="bi-arrow-left-right"
                    title="Change Room"/>

            </a>

            <a
                href="{{ route('students.show',$allocation->student_id) }}">

                <x-admin.action-button
                    color="green"
                    icon="bi-person"
                    title="Student Profile"/>

            </a>

        </div>

    </x-admin.table-cell>

</tr>

@empty

<tr>

    <td colspan="6">

        <x-admin.empty-state
            icon="bi-house"
            title="No Allocations Found"
            message="No room allocations match your search." />

    </td>

</tr>

@endforelse

</tbody>

</table>

<div class="mt-6 flex items-center justify-between border-t border-slate-200 pt-4">

    <p class="text-sm text-slate-500">

        Showing

        <strong>{{ $allocations->firstItem() ?? 0 }}</strong>

        -

        <strong>{{ $allocations->lastItem() ?? 0 }}</strong>

        of

        <strong>{{ $allocations->total() }}</strong>

        active allocations

    </p>

    {{ $allocations->links() }}

</div>

</x-admin.table>

@endsection