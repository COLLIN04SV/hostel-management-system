@extends('layouts.admin')

@section('page-title','System Settings')

@section('content')

<x-admin.page-header
    title="System Settings"
    subtitle="Configure the Hostel Management System">

</x-admin.page-header>

<form
    method="POST"
    action="{{ route('settings.update') }}">

    @csrf

    <x-admin.form-card>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            {{-- System Name --}}
            <x-admin.input
                label="System Name"
                name="system_name"
                :value="old('system_name', $setting->system_name)"
                required
                placeholder="Hostel Management System" />

            {{-- Email --}}
            <x-admin.input
                label="Contact Email"
                name="email"
                type="email"
                :value="old('email', $setting->email)"
                required
                placeholder="admin@example.com" />

            {{-- Phone --}}
            <x-admin.input
                label="Phone Number"
                name="phone"
                :value="old('phone', $setting->phone)"
                placeholder="+2547XXXXXXXX" />

        </div>

        <div class="mt-5">

            <x-admin.textarea
                label="Address"
                name="address"
                rows="5"
                placeholder="Enter school or hostel address">{{ old('address', $setting->address) }}</x-admin.textarea>

        </div>

        <x-admin.form-actions
            :cancel="route('admin.dashboard')"
            submit="Save Settings" />

    </x-admin.form-card>

</form>

@endsection