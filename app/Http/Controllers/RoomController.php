<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Hostel;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
    $rooms = Room::with('hostel')->get();

    return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        $hostels = Hostel::all();

        return view(
            'admin.rooms.create',
            compact('hostels')
        );
    }

    public function store(Request $request)
    {
        Room::create([

            'hostel_id' => $request->hostel_id,
            'room_number' => $request->room_number,
            'floor' => $request->floor,
            'capacity' => $request->capacity,
            'occupied' => 0,
            'price' => $request->price,
            'status' => true

        ]);

        return redirect()
            ->route('rooms.index')
            ->with('success','Room Added Successfully');
    }
}
