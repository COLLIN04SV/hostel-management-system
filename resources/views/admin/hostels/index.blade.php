@extends('layouts.admin')

@section('page-title', 'Hostels')

@section('content')

<x-admin.page-header
    title="Hostels"
    subtitle="Manage hostel blocks">

    <a href="{{ route('hostels.create') }}">

        <x-admin.button color="blue">

            <i class="bi bi-plus-lg mr-2"></i>

            Add Hostel

        </x-admin.button>

    </a>

</x-admin.page-header>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-6">

    <x-admin.stat-card
        title="Total Hostels"
        :value="$totalHostels"
        icon="bi-building"
        color="blue"/>

    <x-admin.stat-card
        title="Male Hostels"
        :value="$maleHostels"
        icon="bi-gender-male"
        color="green"/>

    <x-admin.stat-card
        title="Female Hostels"
        :value="$femaleHostels"
        icon="bi-gender-female"
        color="red"/>

    <x-admin.stat-card
        title="Total Rooms"
        :value="$totalRooms"
        icon="bi-door-open"
        color="yellow"/>

</div>

<x-admin.card>

    <form
        method="GET"
        action="{{ route('hostels.index') }}"
        class="mb-6">

        <div class="flex gap-3">

            <input
                type="text"
                name="search"
                value="{{ $search }}"
                placeholder="Search hostel by name, gender or location..."
                class="flex-1 border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500">

            <x-admin.button color="blue">

                Search

            </x-admin.button>

        </div>

    </form>

    <div class="flex justify-between items-center mb-4">

    <p class="text-gray-500">

        Showing

        <strong>{{ $hostels->firstItem() ?? 0 }}</strong>

        -

        <strong>{{ $hostels->lastItem() ?? 0 }}</strong>

        of

        <strong>{{ $hostels->total() }}</strong>

        hostels

    </p>

</div>

<div class="overflow-x-auto">

    <table class="w-full">

        <thead>

            <tr class="bg-gray-100 text-gray-600 uppercase text-xs tracking-wider">

                <th class="p-4 text-left">Hostel</th>

                <th class="p-4 text-left">Gender</th>

                <th class="p-4 text-center">Capacity</th>

                <th class="p-4 text-left">Location</th>

                <th class="p-4 text-center">Rooms</th>

                <th class="p-4 text-center">Actions</th>

            </tr>

        </thead>

        <tbody>

        @forelse($hostels as $hostel)

            <tr class="border-b hover:bg-blue-50 transition">

                <td class="p-4">

                    <div class="flex items-center gap-3">

                        <div class="w-11 h-11 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center">

                            <i class="bi bi-building"></i>

                        </div>

                        <div>

                            <p class="font-semibold">

                                {{ $hostel->name }}

                            </p>

                            <p class="text-sm text-gray-500">

                                Hostel Block

                            </p>

                        </div>

                    </div>

                </td>

                <td class="p-4">

                    @if($hostel->gender == 'Male')

                        <x-admin.badge
                            type="info"
                            text="Male"/>

                    @else

                        <x-admin.badge
                            type="danger"
                            text="Female"/>

                    @endif

                </td>

                <td class="p-4 text-center font-semibold">

                    {{ $hostel->capacity }}

                </td>

                <td class="p-4">

                    {{ $hostel->location }}

                </td>

                <td class="p-4 text-center">

                    {{ $hostel->rooms()->count() }}

                </td>

                <td class="p-4">

                    <div class="flex justify-center gap-2">

                        <x-admin.action-button
                            href="{{ route('hostels.edit',$hostel) }}"
                            color="blue"
                            icon="bi-pencil-square"/>

                        <form
                            method="POST"
                            action="{{ route('hostels.destroy',$hostel) }}"
                            onsubmit="return confirm('Delete this hostel?')">

                            @csrf
                            @method('DELETE')

                            <x-admin.action-button
                                type="submit"
                                color="red"
                                icon="bi-trash"/>

                        </form>

                    </div>

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="6">

                    <div class="text-center py-12">

                        <i class="bi bi-building text-5xl text-gray-300"></i>

                        <h3 class="mt-4 text-xl font-semibold">

                            No Hostels Found

                        </h3>

                        <p class="text-gray-500 mt-2">

                            Click "Add Hostel" to create your first hostel.

                        </p>

                    </div>

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>

{{-- Pagination --}}
{{ $hostels->links() }}

<div class="mt-6">

    {{ $hostels->links() }}

</div>

</x-admin.card>

@endsection