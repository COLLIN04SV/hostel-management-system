@extends('student.layouts.app')

@section('title','Support')

@section('student-content')

<x-student.page-header
    title="Support Centre"
    subtitle="Submit a request or track previous issues."/>

<div class="grid lg:grid-cols-3 gap-6">

    <div class="lg:col-span-2">

        <x-student.card>

            <form method="POST"
                  action="{{ route('student.support.store') }}">

                @csrf

                <div class="space-y-5">

                    <div>

                        <label class="font-medium">
                            Subject
                        </label>

                        <input
                            type="text"
                            name="subject"
                            class="w-full mt-2 border rounded-lg p-3"
                            required>

                    </div>

                    <div>

                        <label class="font-medium">
                           Message
                        </label>

                        <textarea
                            name="message"
                            rows="6"
                            class="w-full mt-2 border rounded-lg p-3"
                            required></textarea>

                    </div>

                    <button
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg">

                        Submit Request

                    </button>

                </div>

            </form>

        </x-student.card>

    </div>

    <div>

        <x-student.card>

            <h3 class="font-semibold text-lg mb-4">

                Recent Requests

            </h3>

            @forelse($tickets as $ticket)

                <div class="border-b py-4">

                    <p class="font-semibold">

                        {{ $ticket->subject }}

                    </p>

                    <p class="text-sm text-gray-500">
                       {{ $ticket->created_at->format('d M Y') }}
                    </p>

                    <div class="mt-2">

                        @if($ticket->status=='Resolved')

                            <x-student.badge
                                type="green"
                                text="Resolved"/>

                        @elseif($ticket->status=='In Progress')

                            <x-student.badge
                                type="blue"
                                text="In Progress"/>

                        @else

                            <x-student.badge
                                type="yellow"
                                text="Open"/>

                        @endif

                    </div>

                </div>

            @empty

                <p class="text-gray-500">

                    No support requests yet.

                </p>

            @endforelse

        </x-student.card>

    </div>

</div>

@endsection