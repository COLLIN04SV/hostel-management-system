<?php

namespace App\Http\Controllers;

use App\Models\Allocation;
use App\Models\Application;
use App\Models\Hostel;
use App\Models\Notice;
use App\Models\Payment;
use App\Models\Room;
use App\Models\Student;

class DashboardController extends Controller
{
    public function admin()
    {
        $totalStudents = Student::count();

        $totalHostels = Hostel::count();

        $totalRooms = Room::count();

       $occupiedBeds = Room::sum('occupied');

       $totalBeds = Room::sum('capacity');

       $vacantBeds = $totalBeds - $occupiedBeds;

       $occupancyRate = $totalBeds > 0
         ? round(($occupiedBeds / $totalBeds) * 100)
         : 0;

        $totalRevenue = Payment::where('status', 'Paid')
            ->sum('amount');

        $pendingPayments = Payment::where('status','Pending')
            ->sum('amount');

        $recentApplications = Application::with([
            'student.user',
            'hostel'
        ])
        ->latest()
        ->take(5)
        ->get();

        $recentPayments = Payment::with([
            'student.user'
        ])
        ->latest()
        ->take(5)
        ->get();

        $recentNotices = Notice::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(

            'totalStudents',
            'totalHostels',
            'totalRooms',
            'occupiedBeds',
            'vacantBeds',
            'totalBeds',
            'occupancyRate',
            'totalRevenue',
            'pendingPayments',
            'recentApplications',
            'recentPayments',
            'recentNotices'

        ));
    }
}