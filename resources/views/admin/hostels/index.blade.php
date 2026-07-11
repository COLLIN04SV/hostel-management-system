@extends('layouts.admin')

@section('title','Hostels')

@section('page-title','Hostels')

@section('page-description','Manage hostel blocks')

@section('content')

<x-admin.page-header
    title="Hostels"
    subtitle="Manage hostel blocks">

    <x-admin.button
        href="{{ route('hostels.create') }}">

        <i class="bi bi-plus-lg mr-2"></i>

        Add Hostel

    </x-admin.button>

</x-admin.page-header>

@if(session('success'))

<div class="mb-5 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-700">

    <i class="bi bi-check-circle-fill mr-2"></i>

    {{ session('success') }}

</div>

@endif

@if(session('error'))

<div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-700">

    <i class="bi bi-exclamation-circle-fill mr-2"></i>

    {{ session('error') }}

</div>

@endif

<x-admin.stats-grid>

    <x-admin.stat-card
        title="Total Hostels"
        :value="$totalHostels"
        icon="bi-building"
        color="blue"/>

    <x-admin.stat-card
        title="Male Hostels"
        :value="$maleHostels"
        icon="bi-gender-male"
        color="green"/>

    <x-admin.stat-card
        title="Female Hostels"
        :value="$femaleHostels"
        icon="bi-gender-female"
        color="red"/>

    <x-admin.stat-card
        title="Total Rooms"
        :value="$totalRooms"
        icon="bi-door-open"
        color="yellow"/>

</x-admin.stats-grid>

<x-admin.table>

<x-admin.search-bar
    :action="route('hostels.index')"
    :value="$search"
    placeholder="Search hostel by name, gender or location..." />

<div class="flex items-center justify-between mb-5">

    <p class="text-sm text-slate-500">

        Showing

        <strong>{{ $hostels->firstItem() ?? 0 }}</strong>

        -

        <strong>{{ $hostels->lastItem() ?? 0 }}</strong>

        of

        <strong>{{ $hostels->total() }}</strong>

        hostels

    </p>

</div>

<table class="min-w-full">

<thead class="bg-slate-50 border-b">

<tr>

<x-admin.table-heading>

Hostel

</x-admin.table-heading>

<x-admin.table-heading>

Gender

</x-admin.table-heading>

<x-admin.table-heading class="text-center">

Capacity

</x-admin.table-heading>

<x-admin.table-heading>

Location

</x-admin.table-heading>

<x-admin.table-heading class="text-center">

Rooms

</x-admin.table-heading>

<x-admin.table-heading class="text-center">

Actions

</x-admin.table-heading>

</tr>

</thead>

<tbody>

@forelse($hostels as $hostel)

<tr class="border-b border-slate-100 hover:bg-slate-50 transition">

<x-admin.table-cell>

<div class="flex items-center gap-3">

<div class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center">

<i class="bi bi-building"></i>

</div>

<div>

<p class="font-medium text-slate-800">

{{ $hostel->name }}

</p>

<p class="text-xs text-slate-500">

Hostel Block

</p>

</div>

</div>

</x-admin.table-cell>

<x-admin.table-cell class="text-center">

@if($hostel->gender == 'Male')

    <x-admin.badge
        type="info"
        text="Male"/>

@else

    <x-admin.badge
        type="danger"
        text="Female"/>

@endif

</x-admin.table-cell>

<x-admin.table-cell class="text-center font-medium">

{{ $hostel->capacity }}

</x-admin.table-cell>

<x-admin.table-cell>

{{ $hostel->location ?? '-' }}

</x-admin.table-cell>

<x-admin.table-cell class="text-center">

{{ $hostel->rooms()->count() }}

</x-admin.table-cell>

<x-admin.table-cell class="text-center">

<div class="flex items-center justify-center gap-2">

    <x-admin.action-button
        href="{{ route('hostels.edit',$hostel) }}"
        color="blue"
        icon="bi-pencil-square"/>

    <form
        method="POST"
        action="{{ route('hostels.destroy',$hostel) }}"
        onsubmit="return confirm('Delete this hostel?')">

        @csrf
        @method('DELETE')

        <x-admin.action-button
            type="submit"
            color="red"
            icon="bi-trash"/>

    </form>

</div>

</x-admin.table-cell>

</tr>

@empty

<tr>

<td colspan="6">

<x-admin.empty-state
    icon="bi-building"
    title="No Hostels Found"
    message="Click 'Add Hostel' to create your first hostel."/>

</td>

</tr>

@endforelse

</tbody>

</table>

<div class="mt-5 border-t border-slate-200 pt-4">

    {{ $hostels->links() }}

</div>

</x-admin.table>

@endsection