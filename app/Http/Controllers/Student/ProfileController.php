<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $student = Student::where(
            'user_id',
            auth()->id()
        )
        ->with([
            'user',
            'allocation.room.hostel'
        ])
        ->first();

        return view(
            'student.profile.index',
            compact('student')
        );
    }

    public function updatePhoto(Request $request)
{
    $request->validate([
        'profile_photo' => 'required|image|max:2048'
    ]);

    $student = Student::where(
        'user_id',
        auth()->id()
    )->firstOrFail();

    if ($student->profile_photo) {

        Storage::disk('public')->delete(
            $student->profile_photo
        );

    }

    $path = $request
        ->file('profile_photo')
        ->store('profile_photos', 'public');

    $student->update([
        'profile_photo' => $path
    ]);

    return back()->with(
        'success',
        'Profile photo updated successfully.'
    );
}
}