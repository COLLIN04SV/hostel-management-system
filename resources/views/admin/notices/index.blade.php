@extends('layouts.admin')

@section('page-title','Notices')

@section('content')

<x-admin.page-header
    title="Notices"
    subtitle="Create and manage announcements">

    <a href="{{ route('notices.create') }}">
        <x-admin.button color="blue">
            <i class="bi bi-plus-lg mr-2"></i>
            Create Notice
        </x-admin.button>
    </a>

</x-admin.page-header>

<x-admin.card>

@if(session('success'))

<div class="mb-6 rounded-xl bg-green-100 text-green-700 px-4 py-3">

    {{ session('success') }}

</div>

@endif

<div class="overflow-x-auto">

<table class="w-full">

<thead>

<tr class="border-b bg-gray-50">

    <th class="px-6 py-4 text-left">Title</th>

    <th class="px-6 py-4 text-left">Published By</th>

    <th class="px-6 py-4 text-center">Date</th>

    <th class="px-6 py-4 text-center">Status</th>

    <th class="px-6 py-4 text-center">Actions</th>

</tr>

</thead>

<tbody>

@forelse($notices as $notice)

<tr class="border-b hover:bg-gray-50">

    <td class="px-6 py-4">

        <div>

            <h3 class="font-semibold">

                {{ $notice->title }}

            </h3>

            <p class="text-gray-500 text-sm mt-1">

                {{ Str::limit($notice->message,70) }}

            </p>

        </div>

    </td>

    <td class="px-6 py-4">

        {{ $notice->publisher->name ?? '-' }}

    </td>

    <td class="px-6 py-4 text-center">

        {{ \Carbon\Carbon::parse($notice->publish_date)->format('d M Y') }}

    </td>

    <td class="px-6 py-4 text-center">

        @if($notice->status)

            <x-admin.badge
                type="success"
                text="Published"/>

        @else

            <x-admin.badge
                type="warning"
                text="Draft"/>

        @endif

    </td>

    <td class="px-6 py-4">

        <div class="flex justify-center gap-2">

            <a href="{{ route('notices.edit',$notice) }}">

                <x-admin.button color="blue">

                    <i class="bi bi-pencil"></i>

                </x-admin.button>

            </a>

            <form
                method="POST"
                action="{{ route('notices.destroy',$notice) }}">

                @csrf
                @method('DELETE')

                <x-admin.button
                    color="red"
                    type="submit"
                    onclick="return confirm('Delete this notice?')">

                    <i class="bi bi-trash"></i>

                </x-admin.button>

            </form>

        </div>

    </td>

</tr>

@empty

<tr>

<td colspan="5" class="text-center py-12 text-gray-500">

No notices available.

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

</x-admin.card>

@endsection