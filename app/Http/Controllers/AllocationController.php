<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Student;
use App\Models\Allocation;
use App\Models\Payment;
use App\Models\StudentAccount;
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

    $rooms = Room::with('hostel')

        ->whereColumn('occupied', '<', 'capacity')

        ->get();

    return view(
        'admin.allocations.create',
        compact(
            'students',
            'rooms'
        )
    );
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

    if ($student->allocation) {
        return back()->with(
            'error',
            'Student already has an active room allocation.'
        );
    }

    $room = Room::findOrFail($request->room_id);

    if ($room->occupied >= $room->capacity) {
        return back()->with(
            'error',
            'The selected room is already full.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Create Allocation
    |--------------------------------------------------------------------------
    */

    $allocation = Allocation::create([

        'student_id' => $student->id,

        'room_id' => $room->id,

        'allocated_date' => now(),

        'status' => 'Active',

    ]);

    /*
    |--------------------------------------------------------------------------
    | Create Student Financial Account
    |--------------------------------------------------------------------------
    */

    StudentAccount::create([

        'student_id' => $student->id,

        'allocation_id' => $allocation->id,

        'room_fee' => $room->price,

        'amount_paid' => 0,

        'balance' => $room->price,

        'status' => 'Pending',

    ]);

    /*
    |--------------------------------------------------------------------------
    | Update Application
    |--------------------------------------------------------------------------
    */

    $approvedApplication->update([
        'status' => 'Allocated'
    ]);

    /*
    |--------------------------------------------------------------------------
    | Update Room Occupancy
    |--------------------------------------------------------------------------
    */

    $room->increment('occupied');

    return redirect()
        ->route('allocations.index')
        ->with(
            'success',
            'Room allocated successfully.'
        );
}

    public function vacate(int $id)
    {
        $allocation = Allocation::findOrFail($id);

        $allocation->update([
            'status' => 'Vacated',
            'checkout_date' => now(),
        ]);

        return back()->with(
            'success',
            'Student vacated successfully'
        );
    }
}
