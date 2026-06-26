@extends('layouts.admin')

@section('content')

<h1 class="text-3xl font-bold mb-6">
Allocate Room
</h1>

<div class="bg-white p-6 rounded-2xl shadow-sm">

<form method="POST"
      action="{{ route('allocations.store') }}">

@csrf

<div class="grid grid-cols-2 gap-6">

<div>

<label>Student</label>

<select
name="student_id"
class="w-full border p-3 rounded-lg">

@foreach($students as $student)

<option value="{{ $student->id }}">

{{ $student->registration_number }}

</option>

@endforeach

</select>

</div>

<div>

<label>Room</label>

<select
name="room_id"
class="w-full border p-3 rounded-lg">

@foreach($rooms as $room)

<option value="{{ $room->id }}">

{{ $room->room_number }}
(Available:
{{ $room->available_beds }})

</option>

@endforeach

</select>

</div>

</div>

<button
class="bg-blue-600 text-white px-6 py-3 rounded-xl mt-6">

Allocate Room

</button>

</form>

</div>

@endsection