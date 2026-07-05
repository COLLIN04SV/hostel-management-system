@extends('layouts.admin')

@section('page-title','Allocations')

@section('content')

<x-admin.page-header
    title="Room Allocations"
    subtitle="Manage student room allocations">

    <a href="{{ route('allocations.create') }}">

        <x-admin.button color="blue">

            <i class="bi bi-plus-lg mr-2"></i>

            Allocate Student

        </x-admin.button>

    </a>

</x-admin.page-header>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-6">

    <x-admin.stat-card
        title="Total Allocations"
        :value="$totalAllocations"
        icon="bi-house-check"
        color="blue"/>

    <x-admin.stat-card
        title="Active"
        :value="$activeAllocations"
        icon="bi-check-circle"
        color="green"/>

    <x-admin.stat-card
        title="Vacated"
        :value="$vacatedAllocations"
        icon="bi-box-arrow-right"
        color="red"/>

    <x-admin.stat-card
        title="Available Rooms"
        :value="$availableRooms"
        icon="bi-door-open"
        color="yellow"/>

</div>

<x-admin.card>

<form
    method="GET"
    action="{{ route('allocations.index') }}"
    class="mb-6">

    <div class="flex gap-3">

        <input
            type="text"
            name="search"
            value="{{ $search }}"
            placeholder="Search student, registration number, room or status..."
            class="flex-1 border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500">

        <x-admin.button color="blue">

            Search

        </x-admin.button>

    </div>

</form>

<div class="flex justify-between items-center mb-4">

    <p class="text-gray-500">

        Showing

        <strong>{{ $allocations->firstItem() ?? 0 }}</strong>

        -

        <strong>{{ $allocations->lastItem() ?? 0 }}</strong>

        of

        <strong>{{ $allocations->total() }}</strong>

        allocations

    </p>

</div>

<div class="overflow-x-auto">

<table class="w-full">

<thead>

<tr class="bg-gray-100 uppercase text-xs text-gray-600">

    <th class="p-4 text-left">Student</th>

    <th class="p-4 text-left">Hostel</th>

    <th class="p-4 text-left">Room</th>

    <th class="p-4 text-left">Allocated</th>

    <th class="p-4 text-center">Status</th>

    <th class="p-4 text-center">Actions</th>

</tr>

</thead>

<tbody>

@forelse($allocations as $allocation)

<tr class="border-b hover:bg-gray-50 transition">

    <td class="p-4">

        <div class="flex items-center gap-3">

            <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-bold">

                {{ strtoupper(substr($allocation->student->user->name,0,1)) }}

            </div>

            <div>

                <p class="font-semibold">

                    {{ $allocation->student->user->name }}

                </p>

                <p class="text-sm text-gray-500">

                    {{ $allocation->student->registration_number }}

                </p>

            </div>

        </div>

    </td>

    <td class="p-4">

        {{ $allocation->room->hostel->name }}

    </td>

    <td class="p-4">

        {{ $allocation->room->room_number }}

    </td>

    <td class="p-4">

        {{ \Carbon\Carbon::parse($allocation->allocated_date)->format('d M Y') }}

    </td>

    <td class="p-4 text-center">

        @if($allocation->status == 'Active')

            <x-admin.badge type="success">

                Active

            </x-admin.badge>

        @else

            <x-admin.badge type="danger">

                Vacated

            </x-admin.badge>

        @endif

    </td>

    <td class="p-4">

        <div class="flex justify-center gap-2">

            @if($allocation->status == 'Active')

                <form
                    method="POST"
                    action="{{ route('allocations.vacate',$allocation->id) }}">

                    @csrf

                    <x-admin.button
                        type="submit"
                        color="red">

                        <i class="bi bi-box-arrow-right mr-2"></i>

                        Vacate

                    </x-admin.button>

                </form>

            @else

                <span class="text-gray-400 text-sm">

                    No Actions

                </span>

            @endif

        </div>

    </td>

</tr>

@empty

<tr>

    <td colspan="6">

        <div class="text-center py-12">

            <i class="bi bi-house text-5xl text-gray-300"></i>

            <h3 class="mt-4 text-xl font-semibold">

                No Allocations Found

            </h3>

            <p class="text-gray-500 mt-2">

                No room allocations match your search.

            </p>

        </div>

    </td>

</tr>

@endforelse

</tbody>

</table>

</div>

<div class="mt-6">

    {{ $allocations->links() }}

</div>

</x-admin.card>

@endsection