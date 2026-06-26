@extends('student.layouts.app')

@section('title', 'My Applications')

@section('student-content')

<div class="bg-white rounded-lg shadow p-6">

    <h2 class="text-2xl font-bold mb-6">
        My Hostel Applications
    </h2>

    @if($applications->isEmpty())

        <div class="text-gray-500">
            You have not submitted any hostel applications yet.
        </div>

    @else

    <table class="w-full">

        <thead>

        <tr class="border-b">

            <th class="text-left p-3">Hostel</th>
            <th class="text-left p-3">Date</th>
            <th class="text-left p-3">Status</th>

        </tr>

        </thead>

        <tbody>

        @foreach($applications as $application)

        <tr class="border-b">

            <td class="p-3">
                {{ $application->hostel->name }}
            </td>

            <td class="p-3">
                {{ $application->application_date }}
            </td>

            <td class="p-3">

                @if($application->status == 'Pending')

                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">
                        Pending
                    </span>

                @elseif($application->status == 'Approved')

                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">
                        Approved
                    </span>

                @else

                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full">
                        Rejected
                    </span>

                @endif

            </td>

        </tr>

        @endforeach

        </tbody>

    </table>

    @endif

</div>

@endsection