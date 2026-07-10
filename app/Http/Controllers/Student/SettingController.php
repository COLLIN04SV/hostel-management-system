<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class SettingController extends Controller
{
    public function index()
    {
        $student = Student::where(
            'user_id',
            auth()->id()
        )->with('user')->first();

        return view(
            'student.settings.index',
            compact('student')
        );
    }

    public function update(Request $request)
    {
        $request->validate([

            'phone' => 'nullable|max:20',

            'guardian_name' => 'nullable|max:255',

            'guardian_phone' => 'nullable|max:20',

            'address' => 'nullable'

        ]);

        $student = Student::where(
            'user_id',
            auth()->id()
        )->first();

        $student->update([

            'phone' => $request->phone,

            'guardian_name' => $request->guardian_name,

            'guardian_phone' => $request->guardian_phone,

            'address' => $request->address

        ]);

        return back()->with(
            'success',
            'Settings updated successfully.'
        );
    }
}