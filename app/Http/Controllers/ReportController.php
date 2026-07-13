<?php

namespace App\Http\Controllers;

use App\Models\Allocation;
use App\Models\Application;
use App\Models\Hostel;
use App\Models\Payment;
use App\Models\Room;
use App\Models\Student;
use App\Models\StudentAccount;

class ReportController extends Controller
{
    public function index()
    {
        // Student statistics

        $totalStudents = Student::count();

        $allocatedStudents = Allocation::where(
            'status',
            'Active'
        )->count();

        $unallocatedStudents =
            $totalStudents - $allocatedStudents;

        // Hostel statistics

        $totalHostels = Hostel::count();

        // Room statistics

        $totalRooms = Room::count();

        $occupiedBeds = Room::sum('occupied');

        $totalBeds = Room::sum('capacity');

        $vacantBeds = $totalBeds - $occupiedBeds;

        $occupancyRate =
            $totalBeds > 0
                ? round(($occupiedBeds / $totalBeds) * 100)
                : 0;

        // Applications

        $totalApplications = Application::count();

        $pendingApplications = Application::where(
            'status',
            'Pending'
        )->count();

        $approvedApplications = Application::whereIn(
            'status',
            ['Approved', 'Allocated']
        )->count();

        // Student Accounts

        $completedAccounts = StudentAccount::where(
            'status',
            'Completed'
        )->count();

        $partialAccounts = StudentAccount::where(
            'status',
            'Partial'
        )->count();

        $pendingAccounts = StudentAccount::where(
            'status',
            'Pending'
        )->count();

        $totalRevenue = StudentAccount::sum(
            'amount_paid'
        );

        $outstandingBalance = StudentAccount::sum(
            'balance'
        );

                // Recent payments

        $recentPayments = Payment::with([
            'student.user'
        ])
        ->latest()
        ->take(5)
        ->get();

        // Student account report

        $studentAccounts = StudentAccount::with([
            'student.user',
            'allocation.room.hostel'
        ])
        ->latest()
        ->get();

        // Hostel occupancy report

        $hostels = Hostel::with('rooms')->get();

        // Recent allocations

        $recentAllocations = Allocation::with([
            'student.user',
            'room.hostel'
        ])
        ->latest()
        ->take(10)
        ->get();

        return view(
            'admin.reports.index',
            compact(

                'totalStudents',
                'allocatedStudents',
                'unallocatedStudents',

                'totalHostels',

                'totalRooms',
                'occupiedBeds',
                'vacantBeds',
                'totalBeds',
                'occupancyRate',

                'totalApplications',
                'pendingApplications',
                'approvedApplications',

                'completedAccounts',
                'partialAccounts',
                'pendingAccounts',

                'totalRevenue',
                'outstandingBalance',

                'recentPayments',

                'studentAccounts',

                'hostels',

                'recentAllocations'

            )
        );
    }
}