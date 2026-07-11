@extends('layouts.admin')

@section('page-title','Create Notice')

@section('content')

<x-admin.page-header
    title="Create Notice"
    subtitle="Publish a new announcement for students">

</x-admin.page-header>

<form
    method="POST"
    action="{{ route('notices.store') }}">

    @csrf

    <x-admin.form-card>

        <div class="space-y-5">

            {{-- Title --}}
            <x-admin.input
                label="Notice Title"
                name="title"
                :value="old('title')"
                required
                placeholder="Enter notice title" />

            {{-- Message --}}
            <x-admin.textarea
                label="Message"
                name="message"
                rows="6"
                required
                placeholder="Write your announcement here...">

                {{ old('message') }}

            </x-admin.textarea>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                {{-- Publish Date --}}
                <x-admin.input
                    label="Publish Date"
                    name="publish_date"
                    type="date"
                    :value="old('publish_date', now()->format('Y-m-d'))"
                    required />

                {{-- Status --}}
                <x-admin.select
                    label="Status"
                    name="status"
                    required>

                    <option
                        value="1"
                        {{ old('status',1)==1 ? 'selected' : '' }}>

                        Published

                    </option>

                    <option
                        value="0"
                        {{ old('status')==='0' ? 'selected' : '' }}>

                        Draft

                    </option>

                </x-admin.select>

            </div>

        </div>

        <x-admin.form-actions
            :cancel="route('notices.index')"
            submit="Save Notice" />

    </x-admin.form-card>

</form>

@endsection