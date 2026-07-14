<?php

namespace App\Http\Controllers;

use App\Models\Allocation;
use App\Models\Application;
use App\Models\Hostel;
use App\Models\Payment;
use App\Models\Room;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $fromDate = $request->from;
        $toDate = $request->to;

        // Students

        $totalStudents = Student::count();

        // Allocations

        $allocationQuery = Allocation::query();

        if ($fromDate) {
            $allocationQuery->whereDate('allocated_date', '>=', $fromDate);
        }

        if ($toDate) {
            $allocationQuery->whereDate('allocated_date', '<=', $toDate);
        }

        $allocatedStudents = (clone $allocationQuery)
            ->where('status', 'Active')
            ->count();

        $unallocatedStudents = $totalStudents - $allocatedStudents;

        // Hostels

        $totalHostels = Hostel::count();

        // Rooms

        $totalRooms = Room::count();

        $occupiedBeds = Room::sum('occupied');

        $totalBeds = Room::sum('capacity');

        $vacantBeds = $totalBeds - $occupiedBeds;

        $occupancyRate = $totalBeds > 0
            ? round(($occupiedBeds / $totalBeds) * 100)
            : 0;

        // Applications

        $applicationQuery = Application::query();

        if ($fromDate) {
            $applicationQuery->whereDate('application_date', '>=', $fromDate);
        }

        if ($toDate) {
            $applicationQuery->whereDate('application_date', '<=', $toDate);
        }

        $totalApplications = (clone $applicationQuery)->count();

        $pendingApplications = (clone $applicationQuery)
            ->where('status', 'Pending')
            ->count();

        $approvedApplications = (clone $applicationQuery)
            ->whereIn('status', ['Approved', 'Allocated'])
            ->count();

        // Student Accounts

        $studentAccountsQuery = StudentAccount::query();

        $completedAccounts = (clone $studentAccountsQuery)
            ->where('status', 'Completed')
            ->count();

        $partialAccounts = (clone $studentAccountsQuery)
            ->where('status', 'Partial')
            ->count();

        $pendingAccounts = (clone $studentAccountsQuery)
            ->where('status', 'Pending')
            ->count();

        $totalRevenue = (clone $studentAccountsQuery)
            ->sum('amount_paid');

        $outstandingBalance = (clone $studentAccountsQuery)
            ->sum('balance');

        // Payments

        $paymentsQuery = Payment::query();

        if ($fromDate) {
            $paymentsQuery->whereDate('payment_date', '>=', $fromDate);
        }

        if ($toDate) {
            $paymentsQuery->whereDate('payment_date', '<=', $toDate);
        }

        $recentPayments = (clone $paymentsQuery)
            ->with('student.user')
            ->latest('payment_date')
            ->take(5)
            ->get();

        // Student Accounts List

        $studentAccounts = StudentAccount::with([
            'student.user',
            'allocation.room.hostel'
        ])->latest()->get();

        // Hostels

        $hostels = Hostel::with('rooms')->get();

        // Recent Allocations

        $recentAllocations = Allocation::query()

            ->when($fromDate, function ($query) use ($fromDate) {
                $query->whereDate('allocated_date', '>=', $fromDate);
            })

            ->when($toDate, function ($query) use ($toDate) {
                $query->whereDate('allocated_date', '<=', $toDate);
            })

            ->with([
                'student.user',
                'room.hostel'
            ])

            ->latest()

            ->take(10)

            ->get();

        return view(
            'admin.reports.index',
            compact(
                'fromDate',
                'toDate',

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

    public function exportPdf(Request $request)
{
    $fromDate = $request->from;
    $toDate = $request->to;

    // Students

    $totalStudents = Student::count();

    // Allocations

    $allocationQuery = Allocation::query();

    if ($fromDate) {
        $allocationQuery->whereDate('allocated_date', '>=', $fromDate);
    }

    if ($toDate) {
        $allocationQuery->whereDate('allocated_date', '<=', $toDate);
    }

    $allocatedStudents = (clone $allocationQuery)
        ->where('status', 'Active')
        ->count();

    $unallocatedStudents = $totalStudents - $allocatedStudents;

    // Hostels

    $totalHostels = Hostel::count();

    // Rooms

    $totalRooms = Room::count();

    $occupiedBeds = Room::sum('occupied');

    $totalBeds = Room::sum('capacity');

    $vacantBeds = $totalBeds - $occupiedBeds;

    $occupancyRate = $totalBeds > 0
        ? round(($occupiedBeds / $totalBeds) * 100)
        : 0;

    // Student Accounts

    $studentAccounts = StudentAccount::with([
        'student.user',
        'allocation.room.hostel'
    ])->latest()->get();

    $completedAccounts = StudentAccount::wherein('status',[
        'Completed',
        'closed'
    ])->count();

    $partialAccounts = StudentAccount::where(
        'status',
        'Partial'
    )->count();

    $pendingAccounts = StudentAccount::where(
        'status',
        'Pending'
    )->count();

    $totalRevenue = StudentAccount::sum('amount_paid');

    $outstandingBalance = StudentAccount::sum('balance');

    // Hostels

    $hostels = Hostel::with('rooms')->get();

    // Recent Allocations

    $recentAllocations = Allocation::with([
        'student.user',
        'room.hostel'
    ])
    ->latest()
    ->take(10)
    ->get();

    // Recent Payments

    $paymentsQuery = Payment::query();

    if ($fromDate) {
        $paymentsQuery->whereDate('payment_date', '>=', $fromDate);
    }

    if ($toDate) {
        $paymentsQuery->whereDate('payment_date', '<=', $toDate);
    }

    $recentPayments = $paymentsQuery
        ->with('student.user')
        ->latest('payment_date')
        ->take(10)
        ->get();

    $pdf = Pdf::loadView(
        'admin.reports.pdf',
        compact(
            'fromDate',
            'toDate',

            'totalStudents',
            'allocatedStudents',
            'unallocatedStudents',

            'totalHostels',

            'totalRooms',
            'occupiedBeds',
            'vacantBeds',
            'totalBeds',
            'occupancyRate',

            'completedAccounts',
            'partialAccounts',
            'pendingAccounts',

            'totalRevenue',
            'outstandingBalance',

            'studentAccounts',

            'hostels',

            'recentAllocations',

            'recentPayments'
        )
    );

    return $pdf->download(
        'Hostel_Report_' . now()->format('Y_m_d_H_i_s') . '.pdf'
    );
}
}