@extends('student.layouts.app')

@section('title','My Applications')

@section('student-content')

<x-student.page-header
    title="My Applications"
    subtitle="Track the status of your hostel applications" />

{{-- Statistics --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

    <x-student.stat-card
        title="Total Applications"
        :value="$totalApplications"
        icon="bi-file-earmark-text"
        color="indigo"/>

    <x-student.stat-card
        title="Pending"
        :value="$pendingApplications"
        icon="bi-hourglass-split"
        color="yellow"/>

    <x-student.stat-card
        title="Approved"
        :value="$approvedApplications"
        icon="bi-check-circle"
        color="green"/>

</div>

<x-student.card>

    @if($applications->isEmpty())

        <div class="text-center py-16">

            <i class="bi bi-file-earmark-x text-6xl text-gray-300"></i>

            <h3 class="text-xl font-semibold mt-4">
                No Applications Yet
            </h3>

            <p class="text-gray-500 mt-2">
                You haven't submitted any hostel applications.
            </p>

            <a href="{{ route('student.application.create') }}"
               class="inline-block mt-6 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl">

                Apply for Hostel

            </a>

        </div>

    @else

    <div class="space-y-6">

@foreach($applications as $application)

<x-student.card>

    <div class="flex justify-between items-start">

        <div>

            <h2 class="text-xl font-semibold">

                {{ $application->hostel->name }}

            </h2>

            <p class="text-gray-500 mt-1">

                Applied
                {{ \Carbon\Carbon::parse($application->application_date)->format('d M Y') }}

            </p>

        </div>

        @if($application->status == 'Approved')

            <x-student.badge
                type="green"
                text="Approved"/>

        @elseif($application->status == 'Allocated')

            <x-student.badge
                type="blue"
                text="Allocated"/>

        @elseif($application->status == 'Rejected')

            <x-student.badge
                type="red"
                text="Rejected"/>

        @else

            <x-student.badge
                type="yellow"
                text="Pending"/>

        @endif

    </div>

    <hr class="my-6">

    {{-- Timeline goes here --}}

    <div class="mt-6">

    <div class="flex items-center justify-between">

        {{-- Submitted --}}

        <div class="flex flex-col items-center flex-1">

            <div class="w-10 h-10 rounded-full bg-green-500 text-white flex items-center justify-center">

                <i class="bi bi-check-lg"></i>

            </div>

            <p class="mt-2 text-sm font-medium">

                Submitted

            </p>

        </div>

        <div class="flex-1 h-1 bg-gray-300"></div>

        {{-- Review --}}

        <div class="flex flex-col items-center flex-1">

            @if(in_array($application->status,['Approved','Allocated','Rejected']))

                <div class="w-10 h-10 rounded-full bg-green-500 text-white flex items-center justify-center">

                    <i class="bi bi-check-lg"></i>

                </div>

            @else

                <div class="w-10 h-10 rounded-full bg-yellow-500 text-white flex items-center justify-center">

                    <i class="bi bi-hourglass-split"></i>

                </div>

            @endif

            <p class="mt-2 text-sm">

                Review

            </p>

        </div>

        <div class="flex-1 h-1 bg-gray-300"></div>

        {{-- Approved --}}

        <div class="flex flex-col items-center flex-1">

            @if(in_array($application->status,['Approved','Allocated']))

                <div class="w-10 h-10 rounded-full bg-green-500 text-white flex items-center justify-center">

                    <i class="bi bi-check-lg"></i>

                </div>

            @elseif($application->status=='Rejected')

                <div class="w-10 h-10 rounded-full bg-red-500 text-white flex items-center justify-center">

                    <i class="bi bi-x-lg"></i>

                </div>

            @else

                <div class="w-10 h-10 rounded-full bg-gray-300 text-white flex items-center justify-center">

                    <i class="bi bi-circle"></i>

                </div>

            @endif

            <p class="mt-2 text-sm">

                Approved

            </p>

        </div>

        <div class="flex-1 h-1 bg-gray-300"></div>

        {{-- Allocated --}}

        <div class="flex flex-col items-center flex-1">

            @if($application->status=='Allocated')

                <div class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center">

                    <i class="bi bi-house-check"></i>

                </div>

            @else

                <div class="w-10 h-10 rounded-full bg-gray-300 text-white flex items-center justify-center">

                    <i class="bi bi-house"></i>

                </div>

            @endif

            <p class="mt-2 text-sm">

                Room

            </p>

        </div>

    </div>

</div>

<div class="mt-8 rounded-xl bg-gray-50 border border-gray-200 p-4">

    @switch($application->status)

        @case('Pending')

            <p class="text-yellow-700">

                <strong>Application Under Review</strong><br>

                Your application has been received and is awaiting review by the hostel administrator.

            </p>

            @break

        @case('Approved')

            <p class="text-green-700">

                <strong>Application Approved</strong><br>

                Congratulations! Your application has been approved. Room allocation will be done shortly.

            </p>

            @break

        @case('Allocated')

            <p class="text-blue-700">

                <strong>Room Allocated</strong><br>

                Your room has been assigned. Visit the <strong>My Room</strong> page to view your allocation details.

            </p>

            @break

        @case('Rejected')

            <p class="text-red-700">

                <strong>Application Rejected</strong><br>

                Unfortunately, your application was not approved. You may submit another application if permitted.

            </p>

            @break

    @endswitch

</div>

</x-student.card>

@endforeach

</div>
    @endif

</x-student.card>

@endsection