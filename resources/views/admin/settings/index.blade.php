@extends('layouts.admin')

@section('content')

<div class="container">

    <h2 class="mb-4">System Settings</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('settings.update') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>System Name</label>
            <input type="text"
                   name="system_name"
                   class="form-control"
                   value="{{ $setting->system_name }}">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email"
                   name="email"
                   class="form-control"
                   value="{{ $setting->email }}">
        </div>

        <div class="mb-3">
            <label>Phone</label>
            <input type="text"
                   name="phone"
                   class="form-control"
                   value="{{ $setting->phone }}">
        </div>

        <div class="mb-3">
            <label>Address</label>
            <textarea name="address"
                      class="form-control"
                      rows="4">{{ $setting->address }}</textarea>
        </div>

        <button class="btn btn-primary">
            Save Settings
        </button>

    </form>

</div>

@endsection