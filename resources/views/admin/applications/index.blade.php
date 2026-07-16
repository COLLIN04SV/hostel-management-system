@extends('layouts.admin')

@section('title','Applications')

@section('page-title','Applications')

@section('page-description','Manage hostel applications')

@section('content')

<x-admin.page-header
    title="Applications"
    subtitle="Manage hostel applications">

    <div class="flex gap-3">

        {{-- Auto Approve Button --}}
        <form
            action="{{ route('applications.auto-approve') }}"
            method="POST"
            onsubmit="return confirm('Approve ALL pending hostel applications?')">

            @csrf

            <button
                type="submit"
                class="inline-flex items-center px-4 py-2 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white">

                <i class="bi bi-lightning-charge mr-2"></i>

                Auto Approve Pending

            </button>

        </form>

        {{-- Manual Create --}}
        <x-admin.button
            href="{{ route('applications.create') }}">

            <i class="bi bi-plus-lg mr-2"></i>

            New Application

        </x-admin.button>

    </div>

</x-admin.page-header>

<x-admin.stats-grid>

    <x-admin.stat-card
        title="Total Applications"
        :value="$totalApplications"
        icon="bi-file-earmark-text"
        color="blue"/>

    <x-admin.stat-card
        title="Pending"
        :value="$pendingApplications"
        icon="bi-hourglass-split"
        color="yellow"/>

    <x-admin.stat-card
        title="Approved"
        :value="$approvedApplications"
        icon="bi-check-circle"
        color="green"/>

    <x-admin.stat-card
        title="Allocated"
        :value="$allocatedApplications"
        icon="bi-house-check"
        color="info"/>

    <x-admin.stat-card
        title="Rejected"
        :value="$rejectedApplications"
        icon="bi-x-circle"
        color="red"/>

</x-admin.stats-grid>

<x-admin.table>

<x-admin.search-bar
    :action="route('applications.index')"
    :value="$search"
    placeholder="Search student, hostel or status..." />

<div class="flex items-center justify-between mb-5">

    <p class="text-sm text-slate-500">

        Showing

        <strong>{{ $applications->firstItem() ?? 0 }}</strong>

        -

        <strong>{{ $applications->lastItem() ?? 0 }}</strong>

        of

        <strong>{{ $applications->total() }}</strong>

        applications

    </p>

</div>

<table class="min-w-full">

<thead class="bg-slate-50 border-b">

<tr>

<x-admin.table-heading>
Student
</x-admin.table-heading>

<x-admin.table-heading>
Hostel
</x-admin.table-heading>

<x-admin.table-heading>
Application Date
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

@forelse($applications as $application)

<tr class="border-b border-slate-100 hover:bg-slate-50 transition">

<x-admin.table-cell>

<div class="flex items-center gap-3">

<div class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold">

{{ strtoupper(substr($application->student->user->name,0,1)) }}

</div>

<div>

<p class="font-medium text-slate-800">

{{ $application->student->user->name }}

</p>

<p class="text-xs text-slate-500">

{{ $application->student->registration_number }}

</p>

</div>

</div>

</x-admin.table-cell>

<x-admin.table-cell>

{{ $application->hostel->name }}

</x-admin.table-cell>

<x-admin.table-cell>

{{ \Carbon\Carbon::parse($application->application_date)->format('d M Y') }}

</x-admin.table-cell>

<x-admin.table-cell class="text-center">

@if($application->status == 'Approved')

    <x-admin.badge
        type="success"
        text="Approved"/>

@elseif($application->status == 'Allocated')

    <x-admin.badge
        type="info"
        text="Allocated"/>

@elseif($application->status == 'Rejected')

    <x-admin.badge
        type="danger"
        text="Rejected"/>

@else

    <x-admin.badge
        type="warning"
        text="Pending"/>

@endif

</x-admin.table-cell>

<x-admin.table-cell class="text-center">

<div class="flex items-center justify-center gap-2">

@if($application->status == 'Pending')

<form
    method="POST"
    action="{{ route('applications.approve',$application->id) }}">

    @csrf

    <x-admin.action-button
        type="submit"
        color="green"
        icon="bi-check-lg"
        title="Approve"/>

</form>

<form
    method="POST"
    action="{{ route('applications.reject',$application->id) }}">

    @csrf

    <x-admin.action-button
        type="submit"
        color="red"
        icon="bi-x-lg"
        title="Reject"/>

</form>

@elseif($application->status == 'Approved')

<span class="text-xs text-emerald-600 font-semibold">

Ready for Allocation

</span>

@elseif($application->status == 'Allocated')

<span class="text-xs text-indigo-600 font-semibold">

Room Allocated

</span>

@else

<span class="text-xs text-slate-400">

No Actions

</span>

@endif

</div>

</x-admin.table-cell>

</tr>

@empty

<tr>

<td colspan="5">

<x-admin.empty-state
    icon="bi-file-earmark-text"
    title="No Applications Found"
    message="No hostel applications match your search."/>

</td>

</tr>

@endforelse

</tbody>

</table>

<div class="mt-5 border-t border-slate-200 pt-4">

    {{ $applications->links() }}

</div>

</x-admin.table>

@endsection