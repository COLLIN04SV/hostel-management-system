<?php

namespace App\Http\Controllers;

use App\Models\Hostel;
use Illuminate\Http\Request;
use App\Models\Room;

class HostelController extends Controller
{
    public function index(Request $request)
{
    $search = $request->search;

    $hostels = Hostel::when($search, function ($query) use ($search) {

            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('gender', 'like', "%{$search}%");

        })
        ->latest()
        ->paginate(10)
        ->withQueryString();

    $totalHostels = Hostel::count();

    $maleHostels = Hostel::where('gender', 'Male')->count();

    $femaleHostels = Hostel::where('gender', 'Female')->count();

    $totalRooms = Room::count();

    return view('admin.hostels.index', compact(
        'hostels',
        'search',
        'totalHostels',
        'maleHostels',
        'femaleHostels',
        'totalRooms'
    ));
}

    public function create()
    {
        return view('admin.hostels.create');
    }

    public function store(Request $request)
    {
        Hostel::create($request->all());

        return redirect()
            ->route('hostels.index')
            ->with('success', 'Hostel created successfully');
    }

    public function edit(Hostel $hostel)
    {
        return view('admin.hostels.edit', compact('hostel'));
    }

    public function update(Request $request, Hostel $hostel)
    {
        $hostel->update($request->all());

        return redirect()
            ->route('hostels.index')
            ->with('success', 'Hostel updated successfully');
    }

    public function destroy(Hostel $hostel)
    {
        $hostel->delete();

        return back()
            ->with('success', 'Hostel deleted successfully');
    }
}