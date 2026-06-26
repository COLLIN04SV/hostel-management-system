@extends('layouts.admin')

@section('content')

@if(session('success'))
<div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded mb-4">
    <strong>Success!</strong>
    {{ session('success') }}
</div>
@endif

<div class="bg-white rounded-xl shadow p-6">

    <div class="flex justify-between items-center mb-6">

        <div>
            <h2 class="text-2xl font-bold">
                Students
            </h2>

            <p class="text-gray-500">
                Total Students: {{ $students->count() }}
            </p>
        </div>

        <a href="/students/create"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
            + Add Student
        </a>

    </div>

    <div class="mb-4">
        <form method="GET" action="{{ route('students.index') }}">

           <input
             type="text"
             name="search"
             value="{{ $search ?? '' }}"
             placeholder="Search by name, reg no or department..."
             class="w-full border rounded-lg p-3">

        </form>
    </div>

    <table class="w-full">

        <thead>
            <tr class="border-b">
                <th class="p-3">Photo</th>
                <th class="text-left p-3">Reg No</th>
                <th class="text-left p-3">Name</th>
                <th class="text-left p-3">Gender</th>
                <th class="text-left p-3">Department</th>
                <th class="text-left p-3">Year</th>
                <th class="text-left p-3">Room</th>
                <th class="p-3 text-left">Status</th>
                <th class="p-3 text-left">Actions</th>
            </tr>
        </thead>

        <tbody>

        @foreach($students as $student)

        <tr class="border-b">

            <td class="p-3">
                @if($student->profile_photo)
                    <img
                        src="{{ asset('storage/' . $student->profile_photo) }}"
                        alt="Student Photo"
                        class="w-16 h-16 rounded-full object-cover">
                @else
                    <span class="bg-gray-200 text-gray-500 p-2 rounded-full">
                        No Photo
                    </span>
                @endif
            </td>

            <td class="p-3">
                {{ $student->registration_number }}
            </td>

            <td class="p-3">
                {{ $student->user->name }}
            </td>

            <td class="p-3">
                @if($student->gender == 'Male')
               <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                 Male
               </span>
                 @else
              <span class="bg-pink-100 text-pink-700 px-3 py-1 rounded-full text-sm">
                 Female
               </span>
                 @endif
            </td>

            <td class="p-3">
                {{ $student->department }}
            </td>

            <td class="p-3">
                {{ $student->year_of_study }}
            </td>

            <td class="p-3">
                {{ $student->allocation?->room?->room_number ?? 'Not Allocated' }}
            </td>

            <td class="p-3">

             @if($student->allocation)

             <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
             Allocated
             </span>

             @else

             <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
              Pending
             </span>

             @endif

            </td>

            <td class="p-3">

              <div class="flex gap-2">

               <a href="{{ route('students.show', $student->id) }}"
                 class="bg-blue-500 text-white px-4 py-2 rounded">
                  View
               </a>

               <a href="{{ route('students.edit', $student->id) }}"
                   class="bg-green-500 text-white px-4 py-2 rounded">
                 Edit
               </a>

               <form action="{{ route('students.destroy', $student->id) }}"
                     method="POST"
                     style="display:inline;">

                     @csrf
                     @method('DELETE')

                <button
                    type="submit"
                    onclick="return confirm('Are you sure you want to delete this student?')"
                    class="bg-red-500 text-white px-4 py-2 rounded">

                    Delete

                </button>

                </form>

             </div>

            </td>

        </tr>

        @endforeach

        </tbody>

    </table>

</div>

@endsection