<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Room;
use App\Models\Allocation;
use App\Models\Payment;

class ReportController extends Controller
{
    public function index()
    {
        $totalStudents = Student::count();

        $allocatedStudents = Allocation::count();

        $unallocatedStudents =
            $totalStudents - $allocatedStudents;

        $totalRooms = Room::count();

        $occupiedRooms =
          Room::where('occupied', '>', 0)->count();

        $vacantRooms =
          Room::where('occupied', '<', 'capacity')->count();

        $totalPayments = Payment::count();

        $totalCollected = Payment::sum('amount');

        return view('admin.reports.index', compact(
            'totalStudents',
            'allocatedStudents',
            'unallocatedStudents',
            'totalRooms',
            'occupiedRooms',
            'vacantRooms',
            'totalPayments',
            'totalCollected'
        ));
    }
}