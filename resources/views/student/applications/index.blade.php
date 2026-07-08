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

    <x-student.table>

        <thead>

            <tr class="border-b bg-gray-50">

                <th class="text-left px-5 py-4">
                    Hostel
                </th>

                <th class="text-left px-5 py-4">
                    Application Date
                </th>

                <th class="text-center px-5 py-4">
                    Status
                </th>

            </tr>

        </thead>

        <tbody>

        @foreach($applications as $application)

            <tr class="border-b hover:bg-gray-50">

                <td class="px-5 py-4 font-medium">

                    {{ $application->hostel->name }}

                </td>

                <td class="px-5 py-4">

                    {{ \Carbon\Carbon::parse($application->application_date)->format('d M Y') }}

                </td>

                <td class="px-5 py-4 text-center">

                    @if($application->status == 'Approved')

                        <x-student.badge
                            type="green"
                            text="Approved"/>

                    @elseif($application->status == 'Rejected')

                        <x-student.badge
                            type="red"
                            text="Rejected"/>

                    @else

                        <x-student.badge
                            type="yellow"
                            text="Pending"/>

                    @endif

                </td>

            </tr>

        @endforeach

        </tbody>

    </x-student.table>

    @endif

</x-student.card>

@endsection