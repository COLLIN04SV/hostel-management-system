@extends('layouts.admin')

@section('content')

<div class="bg-white p-6 rounded-xl shadow">

    <div class="flex justify-between mb-6">

        <h2 class="text-2xl font-bold">
            Applications
        </h2>

        <a href="{{ route('applications.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded">

            New Application

        </a>

    </div>

    <table class="w-full">

        <thead>

        <tr>
            <th>Student</th>
            <th>Hostel</th>
            <th>Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>

        </thead>

        <tbody>

        @foreach($applications as $application)

        <tr class="border-b">

            <td>
                {{ $application->student->user->name }}
            </td>

            <td>
                {{ $application->hostel->name }}
            </td>

            <td>
                {{ $application->application_date }}
            </td>

            <td>

                @if($application->status=='Approved')

                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">
                    Approved
                </span>

                @elseif($application->status=='Rejected')

                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full">
                    Rejected
                </span>

                @else

                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">
                    Pending
                </span>

                @endif

            </td>

            <td>

                @if($application->status=='Pending')

                <form
                    action="{{ route('applications.approve',$application->id) }}"
                    method="POST"
                    style="display:inline;">

                    @csrf

                    <button class="bg-green-500 text-white px-3 py-1 rounded">
                        Approve
                    </button>

                </form>

                <form
                    action="{{ route('applications.reject',$application->id) }}"
                    method="POST"
                    style="display:inline;">

                    @csrf

                    <button class="bg-red-500 text-white px-3 py-1 rounded">
                        Reject
                    </button>

                </form>

                @endif

            </td>

        </tr>

        @endforeach

        </tbody>

    </table>

</div>

@endsection