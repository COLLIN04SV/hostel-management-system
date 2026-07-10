@extends('student.layouts.app')

@section('title','Notice')

@section('student-content')

<x-student.page-header
    title="Notice"
    subtitle="Read hostel announcement"/>

<x-student.card>

    <h1 class="text-3xl font-bold">

        {{ $notice->title }}

    </h1>

    <p class="text-gray-500 mt-2">

        {{ $notice->created_at->format('d M Y • h:i A') }}

    </p>

    <hr class="my-6">

    <div class="leading-8 text-gray-700 whitespace-pre-line">

        {{ $notice->content }}

    </div>

    <div class="mt-8">

        <a
            href="{{ route('student.notices') }}"
            class="bg-slate-900 text-white px-6 py-3 rounded-lg">

            ← Back to Notices

        </a>

    </div>

</x-student.card>

@endsection