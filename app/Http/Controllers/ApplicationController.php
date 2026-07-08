<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Student;
use App\Models\Hostel;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index(Request $request)
{
    $search = $request->search;

    $applications = Application::with([
            'student.user',
            'hostel'
        ])

        ->when($search, function ($query) use ($search) {

            $query->whereHas('student.user', function ($q) use ($search) {

                $q->where('name', 'like', "%{$search}%");

            })

            ->orWhereHas('hostel', function ($q) use ($search) {

                $q->where('name', 'like', "%{$search}%");

            })

            ->orWhere('status', 'like', "%{$search}%");

        })

        ->latest()

        ->paginate(10)

        ->withQueryString();

    $totalApplications = Application::count();

    $pendingApplications = Application::where(
        'status',
        'Pending'
    )->count();

    $approvedApplications = Application::where(
        'status',
        'Approved'
    )->count();

    $allocatedApplications = Application::where(
    'status',
    'Allocated'
    )->count();

    $rejectedApplications = Application::where(
        'status',
        'Rejected'
    )->count();

    return view(
        'admin.applications.index',
        compact(
            'applications',
            'search',
            'totalApplications',
            'pendingApplications',
            'approvedApplications',
            'allocatedApplications',
            'rejectedApplications'
        )
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

    if ($application->status != 'Pending') {
        return back()->with(
            'error',
            'Only pending applications can be approved.'
        );
    }

    $application->update([
        'status' => 'Approved'
    ]);

    return back()->with(
        'success',
        'Application approved successfully.'
    );
}

    public function reject($id)
{
    $application = Application::findOrFail($id);

    if ($application->status != 'Pending') {
        return back()->with(
            'error',
            'Only pending applications can be rejected.'
        );
    }

    $application->update([
        'status' => 'Rejected'
    ]);

    return back()->with(
        'success',
        'Application rejected successfully.'
    );
}

    public function studentCreate()
{
    $student = Student::where(
        'user_id',
        auth()->id()
    )->first();

    $hostels = Hostel::with(['rooms'])
    ->withCount('rooms')
    ->where('gender', $student->gender)
    ->get();
    
    return view(
        'student.applications.create',
        compact(
            'hostels',
            'student'
        )
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

    $existingApplication = Application::where(
    'student_id',
    $student->id
)
->whereIn('status', [
    'Pending',
    'Approved',
    'Allocated'
])
->first();

if ($existingApplication) {

    return back()->with(
        'error',
        'You already have an active hostel application.'
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
    $student = auth()->user()->student;

    $applications = $student->applications()
        ->with('hostel')
        ->latest()
        ->get();

    return view(
        'student.applications.index',
        [
            'applications' => $applications,

            'totalApplications' => $applications->count(),

            'pendingApplications' =>
                $applications->where('status','Pending')->count(),

            'approvedApplications' =>
                $applications->where('status','Approved')->count(),

            'rejectedApplications' =>
                $applications->where('status','Rejected')->count(),
        ]
    );
}
}