<?php

namespace App\Http\Controllers;

use App\Models\Allocation;
use App\Models\Application;
use App\Models\Room;
use App\Models\Student;
use App\Models\StudentAccount;
use App\Models\Notification;
use Illuminate\Http\Request;

class AllocationController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $allocations = Allocation::with([
                'student.user',
                'room.hostel'
            ])
            ->when($search, function ($query) use ($search) {

                $query->whereHas('student.user', function ($q) use ($search) {

                    $q->where('name', 'like', "%{$search}%");

                })

                ->orWhereHas('student', function ($q) use ($search) {

                    $q->where('registration_number', 'like', "%{$search}%");

                })

                ->orWhereHas('room', function ($q) use ($search) {

                    $q->where('room_number', 'like', "%{$search}%");

                })

                ->orWhere('status', 'like', "%{$search}%");

            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalAllocations = Allocation::count();

        $activeAllocations = Allocation::where(
            'status',
            'Active'
        )->count();

        $vacatedAllocations = Allocation::where(
            'status',
            'Vacated'
        )->count();

        $availableRooms = Room::whereColumn(
            'occupied',
            '<',
            'capacity'
        )->count();

        return view(
            'admin.allocations.index',
            compact(
                'allocations',
                'search',
                'totalAllocations',
                'activeAllocations',
                'vacatedAllocations',
                'availableRooms'
            )
        );
    }

    public function create()
    {
        $students = Student::whereHas('applications', function ($query) {

                $query->where('status', 'Approved');

            })

            ->whereDoesntHave('allocation', function ($query) {

                $query->where('status', 'Active');

            })

            ->with([
                'user',
                'applications.hostel'
            ])

            ->get();

        $rooms = collect();

        return view(
            'admin.allocations.create',
            compact(
                'students',
                'rooms'
            )
        );
    }

    public function getRooms(Student $student)
    {
        $application = Application::where(
                'student_id',
                $student->id
            )
            ->where(
                'status',
                'Approved'
            )
            ->latest()
            ->first();

        if (!$application) {

            return response()->json([]);

        }

        $rooms = Room::where(
                'hostel_id',
                $application->hostel_id
            )
            ->whereColumn(
                'occupied',
                '<',
                'capacity'
            )
            ->orderBy('room_number')
            ->get();

        return response()->json($rooms);
    }

    public function store(Request $request)
{
    $request->validate([
        'student_id' => 'required|exists:students,id',
        'room_id' => 'required|exists:rooms,id',
    ]);

    $student = Student::with('applications')->findOrFail($request->student_id);

    $approvedApplication = $student->applications()
        ->where('status', 'Approved')
        ->latest()
        ->first();

    if (!$approvedApplication) {
        return back()->with(
            'error',
            'This student does not have an approved application.'
        );
    }

    $room = Room::with('hostel')->findOrFail($request->room_id);

    if ($room->hostel_id != $approvedApplication->hostel_id) {

        return back()->with(
            'error',
            'You can only allocate a room from the approved hostel.'
        );

    }

    if ($student->allocation) {

        return back()->with(
            'error',
            'Student already has an active allocation.'
        );

    }

    if ($room->occupied >= $room->capacity) {

        return back()->with(
            'error',
            'Selected room is already full.'
        );

    }

    $allocation = Allocation::create([

        'student_id' => $student->id,

        'room_id' => $room->id,

        'allocated_date' => now(),

        'status' => 'Active',

    ]);

    Notification::create([

    'title' => 'Room Allocated',

    'message' =>
        $student->user->name .
        ' allocated to Room ' .
        $room->room_number .
        ' (' .
        $room->hostel->name .
        ').',

    'type' => 'allocation'

   ]);

    StudentAccount::create([

        'student_id' => $student->id,

        'allocation_id' => $allocation->id,

        'room_fee' => $room->price,

        'amount_paid' => 0,

        'balance' => $room->price,

        'status' => 'Pending',

    ]);

    $approvedApplication->update([

        'status' => 'Allocated'

    ]);

    $room->increment('occupied');

    return redirect()
        ->route('allocations.index')
        ->with(
            'success',
            'Room allocated successfully.'
        );
}

public function changeRoomForm(Allocation $allocation)
{
    if ($allocation->status != 'Active') {

        return back()->with(
            'error',
            'Only active allocations can change rooms.'
        );

    }

    $account = StudentAccount::where(
        'allocation_id',
        $allocation->id
    )->first();

    if (!$account) {

        return back()->with(
            'error',
            'Student account not found.'
        );

    }

    // Only first 14 days after allocation

    if (
        now()->diffInDays($allocation->allocated_date) > 14
    ) {

        return back()->with(
            'error',
            'Room changes are only allowed during the first 14 days.'
        );

    }

    $rooms = Room::where(
            'hostel_id',
            $allocation->room->hostel_id
        )
        ->whereColumn(
            'occupied',
            '<',
            'capacity'
        )
        ->where(
            'id',
            '!=',
            $allocation->room_id
        )
        ->orderBy('room_number')
        ->get();

    return view(
        'admin.allocations.change-room',
        compact(
            'allocation',
            'rooms'
        )
    );
}

public function changeRoom(Request $request, Allocation $allocation)
{
    $request->validate([

        'room_id' => 'required|exists:rooms,id'

    ]);

    if ($allocation->status != 'Active') {

        return back()->with(
            'error',
            'Only active allocations can change rooms.'
        );

    }

    if (
        now()->diffInDays($allocation->allocated_date) > 14
    ) {

        return back()->with(
            'error',
            'Room change period has expired.'
        );

    }

    $newRoom = Room::findOrFail(
        $request->room_id
    );

    if (
        $newRoom->hostel_id !=
        $allocation->room->hostel_id
    ) {

        return back()->with(
            'error',
            'Students can only move within the same hostel.'
        );

    }

    if (
        $newRoom->occupied >=
        $newRoom->capacity
    ) {

        return back()->with(
            'error',
            'Selected room is already full.'
        );

    }

    $oldRoom = $allocation->room;

    $oldRoom->decrement('occupied');

    $newRoom->increment('occupied');

    $allocation->update([

        'room_id' => $newRoom->id

    ]);

    Notification::create([

        'title' => 'Room Changed',

        'message' =>
            $allocation->student->user->name .
            ' moved from Room ' .
            $oldRoom->room_number .
            ' to Room ' .
            $newRoom->room_number .
            '.',

        'type' => 'allocation'

    ]);

    return redirect()
        ->route('allocations.index')
        ->with(
            'success',
            'Room changed successfully.'
        );
}
}