@extends('layouts.admin')

@section('page-title','Applications')

@section('content')

<x-admin.page-header
    title="Applications"
    subtitle="Manage hostel applications">

    <a href="{{ route('applications.create') }}">

        <x-admin.button color="blue">

            <i class="bi bi-plus-lg mr-2"></i>

            New Application

        </x-admin.button>

    </a>

</x-admin.page-header>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-6 mb-6">

    <x-admin.stat-card
        title="Total Applications"
        :value="$totalApplications"
        icon="bi-file-earmark-text"
        color="blue"/>

    <x-admin.stat-card
        title="Pending"
        :value="$pendingApplications"
        icon="bi-hourglass-split"
        color="yellow"/>

    <x-admin.stat-card
        title="Approved"
        :value="$approvedApplications"
        icon="bi-check-circle"
        color="green"/>

    <x-admin.stat-card
        title="Allocated"
        :value="$allocatedApplications"
        icon="bi-house-check"
        color="info"/>    

    <x-admin.stat-card
        title="Rejected"
        :value="$rejectedApplications"
        icon="bi-x-circle"
        color="red"/>

</div>

<x-admin.card>

<form
    method="GET"
    action="{{ route('applications.index') }}"
    class="mb-6">

    <div class="flex gap-3">

        <input
            type="text"
            name="search"
            value="{{ $search }}"
            placeholder="Search student, hostel or status..."
            class="flex-1 border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500">

        <x-admin.button color="blue">

            Search

        </x-admin.button>

    </div>

</form>

<div class="flex justify-between items-center mb-4">

    <p class="text-gray-500">

        Showing

        <strong>{{ $applications->firstItem() ?? 0 }}</strong>

        -

        <strong>{{ $applications->lastItem() ?? 0 }}</strong>

        of

        <strong>{{ $applications->total() }}</strong>

        applications

    </p>

</div>

<div class="overflow-x-auto">

<table class="w-full">

<thead>

<tr class="bg-gray-100 text-gray-600 uppercase text-xs">

    <th class="p-4 text-left">Student</th>

    <th class="p-4 text-left">Hostel</th>

    <th class="p-4 text-left">Date</th>

    <th class="p-4 text-center">Status</th>

    <th class="p-4 text-center">Actions</th>

</tr>

</thead>

<tbody>

@forelse($applications as $application)

<tr class="border-b hover:bg-gray-50 transition">

    <td class="p-4">

        <div class="flex items-center gap-3">

            <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-bold">

                {{ strtoupper(substr($application->student->user->name,0,1)) }}

            </div>

            <div>

                <p class="font-semibold">

                    {{ $application->student->user->name }}

                </p>

                <p class="text-sm text-gray-500">

                    {{ $application->student->registration_number }}

                </p>

            </div>

        </div>

    </td>

    <td class="p-4">

        {{ $application->hostel->name }}

    </td>

    <td class="p-4">

        {{ \Carbon\Carbon::parse($application->application_date)->format('d M Y') }}

    </td>

    <td class="p-4 text-center">

        @if($application->status == 'Approved')

    <x-admin.badge
        type="success"
        text="Approved"/>

@elseif($application->status == 'Allocated')

    <x-admin.badge
        type="info"
        text="Allocated"/>

@elseif($application->status == 'Rejected')

    <x-admin.badge
        type="danger"
        text="Rejected"/>

@else

    <x-admin.badge
        type="warning"
        text="Pending"/>

@endif

    </td>

    <td class="p-4">

        <div class="flex justify-center gap-2">

            @if($application->status == 'Pending')

                <form
                    method="POST"
                    action="{{ route('applications.approve',$application->id) }}">

                    @csrf

                    <x-admin.action-button
                        type="submit"
                        color="green"
                        icon="bi-check-lg"
                        title="Approve"/>

                </form>

                <form
                    method="POST"
                    action="{{ route('applications.reject',$application->id) }}">

                    @csrf

                    <x-admin.action-button
                        type="submit"
                        color="red"
                        icon="bi-x-lg"
                        title="Reject"/>

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

    <td colspan="5">

        <div class="text-center py-12">

            <i class="bi bi-file-earmark-text text-5xl text-gray-300"></i>

            <h3 class="mt-4 text-xl font-semibold">

                No Applications Found

            </h3>

            <p class="text-gray-500 mt-2">

                No hostel applications match your search.

            </p>

        </div>

    </td>

</tr>

@endforelse

</tbody>

</table>

</div>

<div class="mt-6">

    {{ $applications->links() }}

</div>

</x-admin.card>

@endsection