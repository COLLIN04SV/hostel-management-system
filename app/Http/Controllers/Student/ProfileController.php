<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $student = Student::with('user')
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('student.profile.index', compact('student'));
    }
}