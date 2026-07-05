@extends('layouts.admin')

@section('page-title','Create Notice')

@section('content')

<x-admin.page-header
    title="Create Notice"
    subtitle="Publish a new announcement for students">

</x-admin.page-header>

<x-admin.card>

<form
    method="POST"
    action="{{ route('notices.store') }}">

    @csrf

    <div class="space-y-6">

        <div>

            <label class="block mb-2 font-semibold">

                Title

            </label>

            <input
                type="text"
                name="title"
                value="{{ old('title') }}"
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
                required>{{ old('message') }}</textarea>

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
                    value="{{ old('publish_date', now()->format('Y-m-d')) }}"
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

                    <option value="1">

                        Published

                    </option>

                    <option value="0">

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
            color="blue"
            type="submit">

            <i class="bi bi-check-lg mr-2"></i>

            Save Notice

        </x-admin.button>

    </div>

</form>

</x-admin.card>

@endsection