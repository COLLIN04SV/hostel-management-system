@extends('student.layouts.app')

@section('title','Notices')

@section('student-content')

<x-student.page-header
    title="Hostel Notices"
    subtitle="Latest announcements from hostel management"/>

@if($notices->isEmpty())

<x-student.card>

    <div class="text-center py-16">

        <i class="bi bi-megaphone text-6xl text-gray-300"></i>

        <h3 class="text-xl font-semibold mt-4">

            No Notices Available

        </h3>

        <p class="text-gray-500 mt-2">

            Check back later for announcements.

        </p>

    </div>

</x-student.card>

@else

<div class="space-y-6">

    @foreach($notices as $notice)

        <x-student.notice-card
            :notice="$notice"/>

    @endforeach

</div>

@endif

@endsection