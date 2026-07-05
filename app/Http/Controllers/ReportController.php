<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Room;
use App\Models\Allocation;
use App\Models\Payment;
use App\Models\Application;
use App\Models\Hostel;

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

        $totalHostels = Hostel::count();

$totalApplications = Application::count();

$pendingApplications = Application::where(
    'status',
    'Pending'
)->count();

$approvedApplications = Application::where(
    'status',
    'Approved'
)->count();

$recentPayments = Payment::with('student.user')
    ->latest()
    ->take(5)
    ->get();

        return view('admin.reports.index', compact(
            'totalStudents',
            'allocatedStudents',
            'unallocatedStudents',
            'totalRooms',
            'occupiedRooms',
            'vacantRooms',
            'totalPayments',
            'totalCollected',
            'totalHostels',
            'totalApplications',
            'pendingApplications',
            'approvedApplications',
            'recentPayments'
        ));
    }
}