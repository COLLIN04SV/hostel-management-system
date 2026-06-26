<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Student;
use App\Models\Allocation;
use Illuminate\Http\Request;

class AllocationController extends Controller
{
    public function index()
    {
        $allocations = Allocation::with(
            'student',
            'room'
        )->latest()->get();

        return view(
            'admin.allocations.index',
            compact('allocations')
        );
    }

    public function create()
    {
        $students = Student::all();

        $rooms = Room::all();

        return view(
            'admin.allocations.create',
            compact('students','rooms')
        );
    }

    public function store(Request $request)
    {
        $room = Room::findOrFail(
            $request->room_id
        );

        if($room->occupied >= $room->capacity)
        {
            return back()
                ->with(
                    'error',
                    'Room Full'
                );
        }
        $existingAllocation = Allocation::where(
    'student_id',
    $request->student_id
)
->where('status', 'Active')
->first();

if ($existingAllocation) {

    return back()->with(
        'error',
        'Student already has an active room allocation.'
    );
}

$room = Room::findOrFail($request->room_id);

$occupiedBeds = Allocation::where(
    'room_id',
    $room->id
)
->where('status', 'Active')
->count();

if ($occupiedBeds >= $room->capacity) {

    return back()->with(
        'error',
        'Room is already full.'
    );

}
        Allocation::create([

    'student_id' => $request->student_id,
    'room_id' => $request->room_id,
    'allocated_date' => now(),
    'status' => 'Active'

  ]);

        $room->increment('occupied');

        return redirect()
            ->route('allocations.index')
            ->with(
                'success',
                'Room Allocated Successfully'
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
