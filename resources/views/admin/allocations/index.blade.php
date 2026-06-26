@extends('layouts.admin')

@section('content')

@if(session('error'))
<div class="bg-red-100 text-red-700 p-4 rounded mb-4">
    {{ session('error') }}
</div>
@endif

@if(session('success'))
<div class="bg-green-100 text-green-700 p-4 rounded mb-4">
    {{ session('success') }}
</div>
@endif

<h1 class="text-3xl font-bold mb-6">
Room Allocations
</h1>

<a href="{{ route('allocations.create') }}"
class="bg-blue-600 text-white px-5 py-3 rounded-xl">

Allocate Student

</a>

<div class="bg-white p-6 rounded-2xl mt-6">

<table class="w-full">

<thead>

<tr>

<th>Student</th>
<th>Room</th>
<th>Date</th>
<th>Status</th>

</tr>

</thead>

<tbody>

@foreach($allocations as $allocation)

<tr>

@if($allocation->status == 'Active')

<form action="{{ route('allocations.vacate', $allocation->id) }}"
      method="POST">

    @csrf

    <button
        class="bg-red-500 text-white px-3 py-1 rounded">

        Vacate

    </button>

</form>

@endif

<td>
{{ $allocation->student->registration_number }}
</td>

<td>
{{ $allocation->room->room_number }}
</td>

<td>
{{ $allocation->allocated_date }}
</td>

<td>
{{ $allocation->status }}
</td>

</tr>

@endforeach

</tbody>

</table>

</div>

@endsection