<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Notification;

class ViewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('layouts.admin', function ($view) {

            $view->with(

                'notifications',

                Notification::latest()
                    ->take(5)
                    ->get()

            )->with(

                'unreadNotifications',

                Notification::where(
                    'is_read',
                    false
                )->count()

            );

        });
    }
}