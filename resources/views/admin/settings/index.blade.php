@extends('layouts.admin')

@section('page-title','System Settings')

@section('content')

<x-admin.page-header
    title="System Settings"
    subtitle="Configure the Hostel Management System">

</x-admin.page-header>

<x-admin.card>

@if(session('success'))

<div class="mb-6 rounded-xl bg-green-100 text-green-700 px-4 py-3">

    {{ session('success') }}

</div>

@endif

<form
    method="POST"
    action="{{ route('settings.update') }}">

    @csrf

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div>

            <label class="block mb-2 font-semibold">

                System Name

            </label>

            <input
                type="text"
                name="system_name"
                value="{{ old('system_name',$setting->system_name) }}"
                class="w-full border rounded-xl px-4 py-3">

        </div>

        <div>

            <label class="block mb-2 font-semibold">

                Contact Email

            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email',$setting->email) }}"
                class="w-full border rounded-xl px-4 py-3">

        </div>

        <div>

            <label class="block mb-2 font-semibold">

                Phone Number

            </label>

            <input
                type="text"
                name="phone"
                value="{{ old('phone',$setting->phone) }}"
                class="w-full border rounded-xl px-4 py-3">

        </div>

        <div>

            <label class="block mb-2 font-semibold">

                Address

            </label>

            <textarea
                name="address"
                rows="4"
                class="w-full border rounded-xl px-4 py-3">{{ old('address',$setting->address) }}</textarea>

        </div>

    </div>

    <div class="flex justify-end mt-8">

        <x-admin.button
            color="blue"
            type="submit">

            <i class="bi bi-check-circle mr-2"></i>

            Save Settings

        </x-admin.button>

    </div>

</form>

</x-admin.card>

@endsection