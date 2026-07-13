@extends('layouts.admin')

@section('page-title','Notifications')

@section('content')

<x-admin.page-header
    title="Notifications"
    subtitle="System activity notifications"/>

<div class="flex justify-end mb-4">

<form
    method="POST"
    action="{{ route('notifications.readAll') }}">

@csrf

<button
    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">

Mark All As Read

</button>

</form>

</div>

<x-admin.card>

@forelse($notifications as $notification)

<div class="border-b border-slate-200 py-4 flex justify-between items-start">

<div>

<h3 class="font-semibold">

{{ $notification->title }}

</h3>

<p class="text-sm text-slate-600 mt-1">

{{ $notification->message }}

</p>

<p class="text-xs text-slate-400 mt-2">

{{ $notification->created_at->diffForHumans() }}

</p>

</div>

@if(!$notification->is_read)

<form
    method="POST"
    action="{{ route('notifications.read',$notification->id) }}">

@csrf

<button
class="text-blue-600 hover:text-blue-700 text-sm">

Mark Read

</button>

</form>

@endif

</div>

@empty

<x-admin.empty-state
icon="bi-bell"
title="No Notifications"
message="System notifications will appear here."/>

@endforelse

<div class="mt-6">

{{ $notifications->links() }}

</div>

</x-admin.card>

@endsection