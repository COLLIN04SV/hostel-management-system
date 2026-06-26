@extends('layouts.admin')

@section('content')

<h1 class="text-3xl font-bold mb-6">
Edit Hostel
</h1>

<form
method="POST"
action="{{ route('hostels.update',$hostel->id) }}">

@csrf
@method('PUT')

<div class="bg-white p-6 rounded-2xl">

<div class="grid grid-cols-2 gap-6">

<div>
<label>Hostel Name</label>

<input
type="text"
name="name"
value="{{ $hostel->name }}"
class="w-full border p-3 rounded-lg">
</div>

<div>
<label>Gender</label>

<select
name="gender"
class="w-full border p-3 rounded-lg">

<option
{{ $hostel->gender == 'Male' ? 'selected' : '' }}>
Male
</option>

<option
{{ $hostel->gender == 'Female' ? 'selected' : '' }}>
Female
</option>

</select>

</div>

<div>
<label>Capacity</label>

<input
type="number"
name="capacity"
value="{{ $hostel->capacity }}"
class="w-full border p-3 rounded-lg">
</div>

<div>
<label>Location</label>

<input
type="text"
name="location"
value="{{ $hostel->location }}"
class="w-full border p-3 rounded-lg">
</div>

</div>

<div class="mt-6">

<label>Description</label>

<textarea
name="description"
class="w-full border p-3 rounded-lg">{{ $hostel->description }}</textarea>

</div>

<button
class="bg-blue-600 text-white px-6 py-3 rounded-xl mt-6">

Update Hostel

</button>

</div>

</form>

@endsection