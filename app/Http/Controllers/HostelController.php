<?php

namespace App\Http\Controllers;

use App\Models\Hostel;
use Illuminate\Http\Request;

class HostelController extends Controller
{
    public function index()
    {
        $hostels = Hostel::latest()->paginate(10);

        return view('admin.hostels.index', compact('hostels'));
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