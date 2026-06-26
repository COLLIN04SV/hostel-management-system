<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $student = \App\Models\Student::where(
            'user_id',
            $user->id
        )->first();

        $allocation = null;

        if ($student) {
            $allocation = \App\Models\Allocation::with(
                'room.hostel'
            )
            ->where('student_id', $student->id)
            ->where('status', 'Active')
            ->first();
        }

        return view(
            'student.dashboard',
            compact(
                'user',
                'student',
                'allocation'
            )
        );
    }
}