@extends('layouts.admin')

@section('title','Notices')

@section('page-title','Notices')

@section('page-description','Create and manage announcements')

@section('content')

<x-admin.page-header
    title="Notices"
    subtitle="Create and manage announcements">

    <x-admin.button
        href="{{ route('notices.create') }}">

        <i class="bi bi-plus-lg mr-2"></i>

        Create Notice

    </x-admin.button>

</x-admin.page-header>

<x-admin.table>

@if(session('success'))

<div class="mb-5 rounded-xl bg-green-50 border border-green-200 text-green-700 px-4 py-3">

    {{ session('success') }}

</div>

@endif

<div class="flex items-center justify-between mb-5">

<p class="text-sm text-slate-500">

Total Notices:

<strong>{{ $notices->count() }}</strong>

</p>

</div>

<table class="min-w-full">

<thead class="bg-slate-50 border-b">

<tr>

<x-admin.table-heading>

Title

</x-admin.table-heading>

<x-admin.table-heading>

Published By

</x-admin.table-heading>

<x-admin.table-heading class="text-center">

Date

</x-admin.table-heading>

<x-admin.table-heading class="text-center">

Status

</x-admin.table-heading>

<x-admin.table-heading class="text-center">

Actions

</x-admin.table-heading>

</tr>

</thead>

<tbody>

@forelse($notices as $notice)

<tr class="border-b border-slate-100 hover:bg-slate-50 transition">

<x-admin.table-cell>

<div>

<p class="font-medium text-slate-800">

{{ $notice->title }}

</p>

<p class="text-xs text-slate-500 mt-1">

{{ Str::limit($notice->message,70) }}

</p>

</div>

</x-admin.table-cell>

<x-admin.table-cell>

{{ $notice->publisher->name ?? '-' }}

</x-admin.table-cell>

<x-admin.table-cell class="text-center">

{{ \Carbon\Carbon::parse($notice->publish_date)->format('d M Y') }}

</x-admin.table-cell>

<x-admin.table-cell class="text-center">

@if($notice->status)

    <x-admin.badge
        type="success"
        text="Published"/>

@else

    <x-admin.badge
        type="warning"
        text="Draft"/>

@endif

</x-admin.table-cell>

<x-admin.table-cell class="text-center">

<div class="flex items-center justify-center gap-2">

<x-admin.action-button
    href="{{ route('notices.edit',$notice) }}"
    color="blue"
    icon="bi-pencil"
    title="Edit"/>

<form
    method="POST"
    action="{{ route('notices.destroy',$notice) }}"
    onsubmit="return confirm('Delete this notice?')">

    @csrf
    @method('DELETE')

    <x-admin.action-button
        type="submit"
        color="red"
        icon="bi-trash"
        title="Delete"/>

</form>

</div>

</x-admin.table-cell>

</tr>

@empty

<tr>

<td colspan="5">

<x-admin.empty-state
    icon="bi-megaphone"
    title="No Notices Found"
    message="No notices have been published yet."/>

</td>

</tr>

@endforelse

</tbody>

</table>

</x-admin.table>

@endsection