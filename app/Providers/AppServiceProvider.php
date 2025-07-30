<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use App\Models\Project;
use Carbon\Carbon;

use Illuminate\Support\ServiceProvider;

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
        View::composer('*', function ($view) {
        $today = Carbon::today();
        $notifications = Project::whereDate('reminder_date', '<=', $today)
                                ->orderBy('reminder_date', 'asc')
                                ->get();

        $view->with('notifications', $notifications);
        });
    }
}
