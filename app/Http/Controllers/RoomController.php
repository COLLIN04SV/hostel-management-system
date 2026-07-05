<?php

namespace App\Http\Controllers;

use App\Models\Hostel;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display all rooms.
     */
    public function index(Request $request)
{
    $query = Room::with('hostel');

    if ($request->filled('search')) {

        $query->where('room_number', 'like', '%' . $request->search . '%')
              ->orWhereHas('hostel', function ($q) use ($request) {

                    $q->where('name', 'like', '%' . $request->search . '%');

              });
    }

    $rooms = $query
        ->latest()
        ->paginate(10)
        ->withQueryString();

    $totalRooms = Room::count();

    $occupiedRooms = Room::whereColumn('occupied', '>=', 'capacity')->count();

    $availableRooms = $totalRooms - $occupiedRooms;

    $occupancyRate = $totalRooms > 0
        ? round(($occupiedRooms / $totalRooms) * 100)
        : 0;

    return view(
        'admin.rooms.index',
        compact(
            'rooms',
            'totalRooms',
            'occupiedRooms',
            'availableRooms',
            'occupancyRate'
        )
    );
}

    /**
     * Show create form.
     */
    public function create()
    {
        $hostels = Hostel::all();

        return view('admin.rooms.create', compact('hostels'));
    }

    /**
     * Store new room.
     */
    public function store(Request $request)
    {
        $request->validate([

         'hostel_id' => 'required|exists:hostels,id',

         'room_number' => 'required|max:20',

         'floor' => 'required|integer|min:1',

         'capacity' => 'required|integer|min:1',

         'price' => 'required|numeric|min:0',

    ]);

        Room::create([
            'hostel_id' => $request->hostel_id,
            'room_number' => $request->room_number,
            'floor' => $request->floor,
            'capacity' => $request->capacity,
            'occupied' => 0,
            'price' => $request->price,
            'status' => true,
        ]);

        return redirect()
            ->route('rooms.index')
            ->with('success', 'Room added successfully.');
    }

    /**
     * Show edit form.
     */
    public function edit(Room $room)
    {
        $hostels = Hostel::all();

        return view('admin.rooms.edit', compact('room', 'hostels'));
    }

    /**
     * Update room.
     */
    public function update(Request $request, Room $room)
    {
        $request->validate([
            'hostel_id' => 'required|exists:hostels,id',
            'room_number' => 'required|max:50',
            'floor' => 'required|integer|min:1',
            'capacity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'status' => 'required|boolean',
        ]);

        $room->update([
            'hostel_id' => $request->hostel_id,
            'room_number' => $request->room_number,
            'floor' => $request->floor,
            'capacity' => $request->capacity,
            'price' => $request->price,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('rooms.index')
            ->with('success', 'Room updated successfully.');
    }

    /**
     * Delete room.
     */
    public function destroy(Room $room)
    {
        if ($room->occupiedBeds() > 0) {
            return back()->with(
                'error',
                'Cannot delete a room that has allocated students.'
            );
        }

        $room->delete();

        return redirect()
            ->route('rooms.index')
            ->with('success', 'Room deleted successfully.');
    }
}