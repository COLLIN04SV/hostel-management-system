@props([
    'hostel'
])

<div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 hover:shadow-md transition">

    <div class="flex justify-between items-start">

        <div>

            <h3 class="text-xl font-semibold">

                {{ $hostel->name }}

            </h3>

            <p class="text-gray-500 mt-1">

                {{ $hostel->gender }} Hostel

            </p>

        </div>

        <i class="bi bi-building text-3xl text-indigo-600"></i>

    </div>

    <div class="grid grid-cols-2 gap-4 mt-6">

        <div>

            <p class="text-sm text-gray-500">

                Rooms

            </p>

            <p class="font-semibold">

                {{ $hostel->rooms_count }}

            </p>

        </div>

        <div>

          <p class="text-sm text-gray-500">
    Available Rooms
</p>

<p class="font-semibold">
    {{ $hostel->available_rooms_count }}
</p>

        </div>

    </div>

    <form
        method="POST"
        action="{{ route('student.application.store') }}"
        class="mt-6">

        @csrf

        <input
            type="hidden"
            name="hostel_id"
            value="{{ $hostel->id }}">

        <button
            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-xl">

            Apply for this Hostel

        </button>

    </form>

</div>