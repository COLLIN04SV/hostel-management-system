@extends('layouts.admin')

@section('content')

<div class="mb-6">
    <h1 class="text-3xl font-bold">Add Student</h1>
    <p class="text-gray-500">
        Register a new hostel student
    </p>
</div>

<div class="bg-white p-6 rounded-2xl shadow-sm">

<form method="POST"
      action="{{ route('students.store') }}"
      enctype="multipart/form-data">

@csrf

<div class="grid grid-cols-2 gap-6">

    <div>
        <label>Full Name</label>
        <input type="text"
               name="name"
               class="w-full border p-3 rounded-lg mt-2"
               required>
    </div>

    <div>
        <label>Email</label>
        <input type="email"
               name="email"
               class="w-full border p-3 rounded-lg mt-2"
               required>
    </div>

    <div>
        <label>Password</label>
        <input type="password"
               name="password"
               class="w-full border p-3 rounded-lg mt-2"
               required>
    </div>

    <div>
        <label>Registration Number</label>
        <input type="text"
               name="registration_number"
               class="w-full border p-3 rounded-lg mt-2"
               required>
    </div>

    <div>
        <label>Gender</label>

        <select name="gender"
                class="w-full border p-3 rounded-lg mt-2"
                required>

            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>

        </select>
    </div>

    <div>
        <label>Phone</label>
        <input type="text"
               name="phone"
               class="w-full border p-3 rounded-lg mt-2">
    </div>

    <div>
        <label>Department</label>
        <input type="text"
               name="department"
               class="w-full border p-3 rounded-lg mt-2">
    </div>

    <div>
        <label>Year Of Study</label>
        <input type="text"
               name="year_of_study"
               class="w-full border p-3 rounded-lg mt-2">
    </div>

    <div>
        <label>Guardian Name</label>
        <input type="text"
               name="guardian_name"
               class="w-full border p-3 rounded-lg mt-2">
    </div>

    <div>
        <label>Guardian Phone</label>
        <input type="text"
               name="guardian_phone"
               class="w-full border p-3 rounded-lg mt-2">
    </div>

</div>

<div class="mt-6">

    <label>Address</label>

    <textarea
        name="address"
        rows="3"
        class="w-full border p-3 rounded-lg mt-2"></textarea>

</div>

<div class="mb-4">
    <label class="block mb-2">
        Profile Photo
    </label>

    <input
        type="file"
        name="profile_photo"
        class="w-full border rounded p-2">
</div>

<button
    type="submit"
    class="mt-6 bg-blue-600 text-white px-6 py-3 rounded-xl">

    Save Student

</button>

</form>

</div>

@endsection