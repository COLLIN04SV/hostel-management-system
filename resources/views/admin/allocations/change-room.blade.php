@extends('layouts.admin')

@section('title','Change Room')

@section('page-title','Change Room')

@section('page-description','Move a student to another room within the same hostel')

@section('content')

<x-admin.page-header
    title="Change Student Room"
    subtitle="Students may only change rooms within the first 14 days of allocation">

</x-admin.page-header>

<form
    method="POST"
    action="{{ route('allocations.change-room', $allocation->id) }}">

    @csrf
    @method('PUT')

    <x-admin.form-card>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Student Information --}}
            <div>

                <label class="block text-sm font-medium text-slate-700 mb-2">

                    Student

                </label>

                <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">

                    <p class="font-semibold text-slate-800">

                        {{ $allocation->student->user->name }}

                    </p>

                    <p class="text-sm text-slate-500">

                        {{ $allocation->student->registration_number }}

                    </p>

                </div>

            </div>

            {{-- Current Room --}}
            <div>

                <label class="block text-sm font-medium text-slate-700 mb-2">

                    Current Room

                </label>

                <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">

                    <p class="font-semibold">

                        {{ $allocation->room->hostel->name }}

                    </p>

                    <p class="text-sm text-slate-500">

                        Room {{ $allocation->room->room_number }}

                    </p>

                </div>

            </div>

        </div>

        <div class="mt-6">

            <x-admin.select
                label="New Room"
                name="room_id"
                required>

                <option value="">

                    Select New Room

                </option>

                @forelse($rooms as $room)

                    <option
                        value="{{ $room->id }}"
                        {{ old('room_id') == $room->id ? 'selected' : '' }}>

                        Room {{ $room->room_number }}
                        ({{ $room->capacity - $room->occupied }} Bed(s) Available)

                    </option>

                @empty

                    <option disabled>

                        No available rooms

                    </option>

                @endforelse

            </x-admin.select>

            <p class="mt-2 text-xs text-slate-500">

                Only rooms in the same hostel with available space are shown.

            </p>

        </div>

        <div class="mt-8 flex justify-end gap-3">

            <a
                href="{{ route('allocations.index') }}"
                class="px-5 py-2.5 rounded-lg border border-slate-300 hover:bg-slate-100 transition">

                Cancel

            </a>

            <button
                type="submit"
                class="px-5 py-2.5 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white transition">

                <i class="bi bi-arrow-left-right mr-2"></i>

                Change Room

            </button>

        </div>

    </x-admin.form-card>

</form>

@endsection