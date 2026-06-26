@extends('layouts.admin')

@section('content')

<h1 class="text-3xl font-bold mb-6">
Add Hostel
</h1>

<form method="POST" action="{{ route('hostels.store') }}">

@csrf

<div class="bg-white p-6 rounded-2xl">

<div class="grid grid-cols-2 gap-6">

<div>
<label>Hostel Name</label>

<input type="text"
name="name"
class="w-full border p-3 rounded-lg">
</div>

<div>
<label>Gender</label>

<select
name="gender"
class="w-full border p-3 rounded-lg">

<option>Male</option>
<option>Female</option>

</select>

</div>

<div>
<label>Capacity</label>

<input type="number"
name="capacity"
class="w-full border p-3 rounded-lg">

</div>

<div>
<label>Location</label>

<input type="text"
name="location"
class="w-full border p-3 rounded-lg">

</div>

</div>

<div class="mt-6">

<label>Description</label>

<textarea
name="description"
class="w-full border p-3 rounded-lg"></textarea>

</div>

<button
class="bg-blue-600 text-white px-6 py-3 rounded-xl mt-6">

Save Hostel

</button>

</div>

</form>

@endsection