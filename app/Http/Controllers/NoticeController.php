<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\NoticeRead;
use App\Models\Student;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notice::latest()->get();

        return view('admin.notices.index', compact('notices'));
    }

    public function create()
    {
        return view('admin.notices.create');
    }

    public function store(Request $request)
    {
        Notice::create([
            'title' => $request->title,
            'message' => $request->message,
            'published_by' => auth()->id(),
            'publish_date' => $request->publish_date,
            'status' => $request->status
        ]);

        return redirect()->route('notices.index')
            ->with('success','Notice created successfully');
    }

    public function edit(Notice $notice)
    {
        return view('admin.notices.edit', compact('notice'));
    }

    public function update(Request $request, Notice $notice)
    {
        $notice->update($request->all());

        return redirect()->route('notices.index')
            ->with('success','Notice updated');
    }

    public function destroy(Notice $notice)
    {
        $notice->delete();

        return redirect()->route('notices.index')
            ->with('success','Notice deleted');
    }

   public function studentIndex()
{
    $notices = Notice::latest()->paginate(10);

    return view(
        'student.notices.index',
        compact('notices')
    );
}

public function studentShow(Notice $notice)
{
    $student = Student::where(
        'user_id',
        auth()->id()
    )->first();

    NoticeRead::firstOrCreate([

        'student_id' => $student->id,

        'notice_id' => $notice->id

    ]);

    return view(
        'student.notices.show',
        compact('notice')
    );
}
}