<?php

namespace App\Providers;

use App\Models\Staff;
use App\Models\Student;
use App\Observers\StaffObserver;
use App\Observers\StudentObserver;
use Illuminate\Support\ServiceProvider;

class ObserbverProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Staff::observe(StaffObserver::class);
        Student::observe(StudentObserver::class);
    }
}
