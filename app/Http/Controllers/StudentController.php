<?php

namespace App\Http\Controllers;

use App\models\User;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
 {
    $search = $request->search;

    $students = Student::with([
        'user',
        'allocation.room'
    ])

    ->when($search, function ($query) use ($search) {

        $query->where('registration_number', 'like', "%{$search}%")
              ->orWhere('department', 'like', "%{$search}%")
              ->orWhereHas('user', function ($q) use ($search) {

                  $q->where('name', 'like', "%{$search}%");

              });

    })

    ->latest()
    ->get();

    return view(
        'admin.students.index',
        compact('students', 'search')
    );
 }

    public function create()
    {
        return view('admin.students.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'registration_number' => 'required|unique:students,registration_number',
        'gender' => 'required',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => 'student'
    ]);

    $photoPath = null;

  if ($request->hasFile('profile_photo')) {

    $photoPath = $request
        ->file('profile_photo')
        ->store('students', 'public');
  }

   Student::create([
    'user_id' => $user->id,
    'registration_number' => $request->registration_number,
    'gender' => $request->gender,
    'phone' => $request->phone,
    'department' => $request->department,
    'year_of_study' => $request->year_of_study,
    'guardian_name' => $request->guardian_name,
    'guardian_phone' => $request->guardian_phone,
    'address' => $request->address,
    'profile_photo' => $photoPath,
]);

    return redirect('/students')
        ->with('success', 'Student created successfully');
}

public function show(Student $student)
{
    return view('admin.students.show', compact('student'));
}

public function edit(Student $student)
{
    return view('admin.students.edit', compact('student'));
}

public function update(Request $request, Student $student)
{
    $request->validate([
        'phone' => 'required',
        'department' => 'required',
        'year_of_study' => 'required',
        'guardian_name' => 'nullable',
        'guardian_phone' => 'nullable',
        'address' => 'nullable',
    ]);

    $student->update([
        'phone' => $request->phone,
        'department' => $request->department,
        'year_of_study' => $request->year_of_study,
        'guardian_name' => $request->guardian_name,
        'guardian_phone' => $request->guardian_phone,
        'address' => $request->address,
    ]);

    return redirect()
        ->route('students.index')
        ->with('success', 'Student updated successfully.');
}

public function destroy(Student $student)
{
    $student->delete();

    return redirect()
        ->route('students.index')
        ->with('success', 'Student deleted successfully.');
}
}
