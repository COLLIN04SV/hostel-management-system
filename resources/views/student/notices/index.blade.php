@extends('student.layouts.app')

@section('title','Notices')

@section('student-content')

<x-student.page-header
    title="Hostel Notices"
    subtitle="Latest announcements from hostel management."/>

<div class="space-y-6">

@forelse($notices as $notice)

<x-student.card>

    <h2 class="text-xl font-semibold">
        {{ $notice->title }}
    </h2>

    <p class="text-sm text-gray-500 mt-1">
        {{ $notice->created_at->diffForHumans() }}
    </p>

    <p class="mt-4 text-gray-600">
        {{ \Illuminate\Support\Str::limit($notice->content,150) }}
    </p>

    <div class="mt-5">

        <a
            href="{{ route('student.notices.show',$notice) }}"
            class="text-indigo-600 font-semibold hover:text-indigo-800">

            Read More →

        </a>

    </div>

</x-student.card>

@empty

<x-student.card>

    <div class="text-center py-10 text-gray-500">

        No notices available.

    </div>

</x-student.card>

@endforelse

</div>

@endsection