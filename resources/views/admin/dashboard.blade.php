@extends('layouts.admin')

@section('content')

<div class="grid grid-cols-4 gap-6 mb-8">

    <div class="bg-white rounded-2xl shadow-sm p-6">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-gray-500">Students</p>
                <h2 class="text-4xl font-bold mt-2">{{ $students }}</h2>
            </div>

            <i class="bi bi-people text-4xl text-blue-600"></i>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm p-6">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-gray-500">Rooms</p>
                <h2 class="text-4xl font-bold mt-2">{{ $rooms }}</h2>
            </div>

            <i class="bi bi-door-open text-4xl text-green-600"></i>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm p-6">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-gray-500">Occupancy</p>
                <h2 class="text-4xl font-bold mt-2">{{ $occupancy }}%</h2>
            </div>

            <i class="bi bi-bar-chart text-4xl text-orange-500"></i>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm p-6">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-gray-500">Revenue</p>
                <h2 class="text-4xl font-bold mt-2">$0</h2>
            </div>

            <i class="bi bi-cash-stack text-4xl text-purple-600"></i>
        </div>
    </div>

</div>

<div class="grid grid-cols-2 gap-6">

    <div class="bg-white rounded-2xl shadow-sm p-6">

        <h3 class="text-xl font-bold mb-4">
            Recent Notices
        </h3>

        <div class="border-l-4 border-blue-600 pl-4 py-2">
            No notices available
        </div>

    </div>

    <div class="bg-white rounded-2xl shadow-sm p-6">

        <h3 class="text-xl font-bold mb-4">
            Quick Actions
        </h3>

        <div class="grid grid-cols-2 gap-4">

            <button class="bg-blue-600 text-white p-3 rounded-xl">
                Add Student
            </button>

            <button class="bg-green-600 text-white p-3 rounded-xl">
                Add Room
            </button>

            <button class="bg-purple-600 text-white p-3 rounded-xl">
                Add Hostel
            </button>

            <button class="bg-orange-500 text-white p-3 rounded-xl">
                Create Notice
            </button>

        </div>

    </div>

</div>

@endsection