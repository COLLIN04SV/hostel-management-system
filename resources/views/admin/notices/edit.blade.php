@extends('layouts.admin')

@section('page-title','Edit Notice')

@section('content')

<x-admin.page-header
    title="Edit Notice"
    subtitle="Update an existing announcement">

</x-admin.page-header>

<x-admin.card>

<form
    method="POST"
    action="{{ route('notices.update', $notice) }}">

    @csrf
    @method('PUT')

    <div class="space-y-6">

        <div>

            <label class="block mb-2 font-semibold">

                Title

            </label>

            <input
                type="text"
                name="title"
                value="{{ old('title', $notice->title) }}"
                class="w-full border rounded-xl px-4 py-3"
                required>

            @error('title')

                <p class="text-red-500 text-sm mt-2">

                    {{ $message }}

                </p>

            @enderror

        </div>

        <div>

            <label class="block mb-2 font-semibold">

                Message

            </label>

            <textarea
                name="message"
                rows="6"
                class="w-full border rounded-xl px-4 py-3"
                required>{{ old('message', $notice->message) }}</textarea>

            @error('message')

                <p class="text-red-500 text-sm mt-2">

                    {{ $message }}

                </p>

            @enderror

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>

                <label class="block mb-2 font-semibold">

                    Publish Date

                </label>

                <input
                    type="date"
                    name="publish_date"
                    value="{{ old('publish_date', \Carbon\Carbon::parse($notice->publish_date)->format('Y-m-d')) }}"
                    class="w-full border rounded-xl px-4 py-3"
                    required>

            </div>

            <div>

                <label class="block mb-2 font-semibold">

                    Status

                </label>

                <select
                    name="status"
                    class="w-full border rounded-xl px-4 py-3">

                    <option value="1"
                        {{ $notice->status ? 'selected' : '' }}>

                        Published

                    </option>

                    <option value="0"
                        {{ !$notice->status ? 'selected' : '' }}>

                        Draft

                    </option>

                </select>

            </div>

        </div>

    </div>

    <div class="flex justify-end gap-3 mt-8">

        <a href="{{ route('notices.index') }}">

            <x-admin.button color="gray">

                Cancel

            </x-admin.button>

        </a>

        <x-admin.button
            color="green"
            type="submit">

            <i class="bi bi-check2-circle mr-2"></i>

            Update Notice

        </x-admin.button>

    </div>

</form>

</x-admin.card>

@endsection