<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Room;
use App\Models\Hostel;
use App\Models\Allocation;

class DashboardController extends Controller
{
   public function admin()
{
    $students = Student::count();

    $hostels = Hostel::count();

    $rooms = Room::count();

    $allocatedBeds = Allocation::where(
        'status',
        'Active'
    )->count();

    $totalBeds = Room::sum('capacity');

    $occupancy = $totalBeds > 0
        ? round(($allocatedBeds / $totalBeds) * 100)
        : 0;

    $pendingApplications =
        \App\Models\Application::where(
            'status',
            'Pending'
        )->count();

    $payments =
        \App\Models\Payment::sum('amount');

    $recentApplications =
        \App\Models\Application::latest()
        ->take(5)
        ->get();

    $recentPayments =
        \App\Models\Payment::latest()
        ->take(5)
        ->get();

    $recentNotices =
        \App\Models\Notice::latest()
        ->take(5)
        ->get();

    return view(
        'admin.dashboard',
        compact(
            'students',
            'hostels',
            'rooms',
            'allocatedBeds',
            'totalBeds',
            'occupancy',
            'pendingApplications',
            'payments',
            'recentApplications',
            'recentPayments',
            'recentNotices'
        )
    );
}
}