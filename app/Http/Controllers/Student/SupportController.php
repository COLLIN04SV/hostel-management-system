<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\SupportTicket;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index()
    {
        $student = Student::where(
            'user_id',
            auth()->id()
        )->first();

        $tickets = $student
            ? $student->supportTickets()->latest()->get()
            : collect();

        return view(
            'student.support',
            compact(
                'tickets'
            )
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|max:255',
            'message' => 'required'
        ]);

        $student = Student::where(
            'user_id',
            auth()->id()
        )->first();

        SupportTicket::create([

            'student_id' => $student->id,

            'subject' => $request->subject,

            'message' => $request->message,

            'status' => 'Open'

        ]);

        return back()->with(
            'success',
            'Support request submitted successfully.'
        );
    }
}