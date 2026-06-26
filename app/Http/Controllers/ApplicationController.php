<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Student;
use App\Models\Hostel;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::with([
            'student.user',
            'hostel'
        ])->latest()->get();

        return view(
            'admin.applications.index',
            compact('applications')
        );
    }

    public function create()
    {
        $students = Student::all();
        $hostels = Hostel::all();

        return view(
            'admin.applications.create',
            compact('students', 'hostels')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'hostel_id' => 'required'
        ]);

        Application::create([
            'student_id' => $request->student_id,
            'hostel_id' => $request->hostel_id,
            'application_date' => now(),
            'status' => 'Pending'
        ]);

        return redirect()
            ->route('applications.index')
            ->with(
                'success',
                'Application submitted successfully'
            );
    }

    public function approve($id)
    {
        $application = Application::findOrFail($id);

        $application->update([
            'status' => 'Approved'
        ]);

        return back();
    }

    public function reject($id)
    {
        $application = Application::findOrFail($id);

        $application->update([
            'status' => 'Rejected'
        ]);

        return back();
    }

    public function studentCreate()
   {
    $hostels = Hostel::all();

    return view(
        'student.applications.create',
        compact('hostels')
    );
   }

public function studentStore(Request $request)
{
    $request->validate([
        'hostel_id' => 'required'
    ]);

    $student = Student::where(
        'user_id',
        auth()->id()
    )->first();

    if (!$student) {
        return back()->with(
            'error',
            'Student profile not found'
        );
    }

    Application::create([
        'student_id' => $student->id,
        'hostel_id' => $request->hostel_id,
        'application_date' => now(),
        'status' => 'Pending'
    ]);

    return redirect()
        ->route('student.dashboard')
        ->with(
            'success',
            'Application submitted successfully'
        );
}

public function studentIndex()
{
    $student = Student::where(
        'user_id',
        auth()->id()
    )->first();

    if (!$student) {
        return redirect()
            ->route('student.dashboard')
            ->with('error', 'Student profile not found.');
    }

    $applications = Application::with('hostel')
        ->where('student_id', $student->id)
        ->latest()
        ->get();

    return view(
        'student.applications.index',
        compact('applications')
    );
}
}