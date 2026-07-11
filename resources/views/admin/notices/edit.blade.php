@extends('layouts.admin')

@section('page-title','Edit Notice')

@section('content')

<x-admin.page-header
    title="Edit Notice"
    subtitle="Update an existing announcement">

</x-admin.page-header>

<form
    method="POST"
    action="{{ route('notices.update', $notice) }}">

    @csrf
    @method('PUT')

    <x-admin.form-card>

        <div class="space-y-5">

            {{-- Title --}}
            <x-admin.input
                label="Notice Title"
                name="title"
                :value="old('title', $notice->title)"
                required
                placeholder="Enter notice title" />

            {{-- Message --}}
            <x-admin.textarea
                label="Message"
                name="message"
                rows="6"
                required
                placeholder="Write your announcement here...">{{ old('message', $notice->message) }}</x-admin.textarea>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                {{-- Publish Date --}}
                <x-admin.input
                    label="Publish Date"
                    name="publish_date"
                    type="date"
                    :value="old('publish_date', \Carbon\Carbon::parse($notice->publish_date)->format('Y-m-d'))"
                    required />

                {{-- Status --}}
                <x-admin.select
                    label="Status"
                    name="status"
                    required>

                    <option
                        value="1"
                        {{ old('status', $notice->status) == 1 ? 'selected' : '' }}>

                        Published

                    </option>

                    <option
                        value="0"
                        {{ old('status', $notice->status) == 0 ? 'selected' : '' }}>

                        Draft

                    </option>

                </x-admin.select>

            </div>

        </div>

        <x-admin.form-actions
            :cancel="route('notices.index')"
            submit="Update Notice" />

    </x-admin.form-card>

</form>

@endsection