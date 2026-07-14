<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Student;
use App\Models\Hostel;
use App\Models\Notification;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index(Request $request)
{
    $completedApplications = Application::where(
    'status',
    'Completed'
)->count();

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
            'rejectedApplications',
            'completedApplications'
        )
    );
}

   public function create()
{
    // Only students without an active allocation
    $students = Student::whereDoesntHave('allocations', function ($query) {
        $query->where('status', 'Active');
    })
    ->with('user')
    ->orderBy('registration_number')
    ->get();

    // Hostels are loaded dynamically after selecting a student
    $hostels = collect();

    return view(
        'admin.applications.create',
        compact('students', 'hostels')
    );
}

   public function getHostels(Student $student)
{
    $hostels = Hostel::where(
        'gender',
        $student->gender
    )
    ->orderBy('name')
    ->get();

    return response()->json($hostels);
}

   public function store(Request $request)
{
    $request->validate([
        'student_id' => 'required|exists:students,id',
        'hostel_id' => 'required|exists:hostels,id'
    ]);

    $student = Student::findOrFail($request->student_id);

    // Prevent applications for allocated students
    $activeAllocation = $student->allocations()
        ->where('status', 'Active')
        ->exists();

    if ($activeAllocation) {

        return back()->with(
            'error',
            'This student already has an active room allocation.'
        );

    }

    // Prevent duplicate active applications
    $existingApplication = Application::where(
        'student_id',
        $student->id
    )
    ->whereIn('status', [
        'Pending',
        'Approved',
        'Allocated'
    ])
    ->latest()
    ->exists();

    if ($existingApplication) {

        return back()->with(
            'error',
            'This student already has an active application.'
        );

    }

    $hostel = Hostel::findOrFail($request->hostel_id);

    // Gender check
    if ($student->gender != $hostel->gender) {

        return back()->with(
            'error',
            'Student gender does not match the selected hostel.'
        );

    }

    Application::create([

        'student_id' => $student->id,

        'hostel_id' => $hostel->id,

        'application_date' => now(),

        'status' => 'Pending'

    ]);

    $student = Student::with('user')->find($request->student_id);

    Notification::create([

    'title' => 'New Hostel Application',

    'message' => $student->user->name .
        ' submitted a hostel application.',

    'type' => 'application'

   ]);

    return redirect()
        ->route('applications.index')
        ->with(
            'success',
            'Application submitted successfully.'
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

    Notification::create([

    'title' => 'Application Approved',

    'message' =>
        $application->student->user->name .
        ' application has been approved.',

    'type' => 'application'

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

    Notification::create([

    'title' => 'Application Rejected',

    'message' =>
        $application->student->user->name .
        ' application has been rejected.',

    'type' => 'application'

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

   $hostels = Hostel::with('rooms')
    ->withCount('rooms')
    ->withCount([
        'rooms as available_rooms_count' => function ($query) {
            $query->whereColumn('occupied', '<', 'capacity');
        }
    ])
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
->latest()
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