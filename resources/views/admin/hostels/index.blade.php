@extends('layouts.admin')

@section('content')

<div class="flex justify-between items-center mb-6">

    <div>
        <h1 class="text-3xl font-bold">
            Hostels
        </h1>

        <p class="text-gray-500">
            Manage Hostel Blocks
        </p>
    </div>

    <a href="{{ route('hostels.create') }}"
       class="bg-blue-600 text-white px-5 py-3 rounded-xl">

        Add Hostel

    </a>

</div>

<div class="bg-white p-6 rounded-2xl shadow-sm">

<table class="w-full">

<thead>
<tr class="border-b">

    <th class="text-left py-3">Name</th>
    <th class="text-left py-3">Gender</th>
    <th class="text-left py-3">Capacity</th>
    <th class="text-left py-3">Location</th>
    <th class="text-left py-3">Actions</th>

</tr>
</thead>

<tbody>

@foreach($hostels as $hostel)

<tr class="border-b">

    <td>{{ $hostel->name }}</td>
    <td>{{ $hostel->gender }}</td>
    <td>{{ $hostel->capacity }}</td>
    <td>{{ $hostel->location }}</td>

    <td class="py-3">

        <a href="{{ route('hostels.edit',$hostel->id) }}"
           class="text-blue-600">

           Edit

        </a>

    </td>

</tr>

@endforeach

</tbody>

</table>

</div>

@endsection