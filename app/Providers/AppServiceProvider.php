<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Notice;
use App\Models\Student;
use App\Models\NoticeRead;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
{
    View::composer('student.layouts.app', function ($view) {

    $student = null;

    if (Auth::check()) {

        $student = Student::where(
            'user_id',
            Auth::id()
        )->first();

    }

    $latestNotices = Notice::latest()
        ->take(5)
        ->get();

    $unreadNotices = 0;

    if ($student) {

        $unreadNotices = Notice::whereDoesntHave(
            'reads',
            function ($query) use ($student) {

                $query->where(
                    'student_id',
                    $student->id
                );

            }
        )->count();

    }

    $view->with([

        'latestNotices' => $latestNotices,

        'unreadNotices' => $unreadNotices

    ]);

 });
}
}
