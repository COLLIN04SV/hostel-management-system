<?php

namespace App\Http\Controllers;

use App\Models\Allocation;
use App\Models\Application;
use App\Models\Hostel;
use App\Models\Notice;
use App\Models\Payment;
use App\Models\Room;
use App\Models\Student;
use App\Models\StudentAccount;

class DashboardController extends Controller
{
    public function admin()
    {
        /*
        |--------------------------------------------------------------------------
        | Basic Statistics
        |--------------------------------------------------------------------------
        */

        $totalStudents = Student::count();

        $totalHostels = Hostel::count();

        $totalRooms = Room::count();

        $activeAllocations = Allocation::where(
            'status',
            'Active'
        )->count();

        /*
        |--------------------------------------------------------------------------
        | Bed Occupancy
        |--------------------------------------------------------------------------
        */

        $occupiedBeds = Room::sum('occupied');

        $totalBeds = Room::sum('capacity');

        $vacantBeds = max(
            0,
            $totalBeds - $occupiedBeds
        );

        $occupancyRate = $totalBeds > 0
            ? round(($occupiedBeds / $totalBeds) * 100)
            : 0;

        /*
        |--------------------------------------------------------------------------
        | Financial Summary
        |--------------------------------------------------------------------------
        */

        $totalRevenue = Payment::sum('amount');

        $outstandingBalance = StudentAccount::sum('balance');

        $totalRoomFees = StudentAccount::sum('room_fee');

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

        /*
        |--------------------------------------------------------------------------
        | Recent Applications
        |--------------------------------------------------------------------------
        */

        $recentApplications = Application::with([
                'student.user',
                'hostel'
            ])
            ->latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Recent Payments
        |--------------------------------------------------------------------------
        */

        $recentPayments = Payment::with([
                'student.user'
            ])
            ->latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Recent Allocations
        |--------------------------------------------------------------------------
        */

        $recentAllocations = Allocation::with([
                'student.user',
                'room.hostel'
            ])
            ->latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Recent Notices
        |--------------------------------------------------------------------------
        */

        $recentNotices = Notice::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(

            'totalStudents',
            'totalHostels',
            'totalRooms',

            'activeAllocations',

            'occupiedBeds',
            'vacantBeds',
            'totalBeds',
            'occupancyRate',

            'totalRevenue',
            'outstandingBalance',
            'totalRoomFees',

            'completedAccounts',
            'partialAccounts',
            'pendingAccounts',

            'recentApplications',
            'recentPayments',
            'recentAllocations',
            'recentNotices'

        ));
    }
}