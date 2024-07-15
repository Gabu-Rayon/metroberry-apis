<?php

namespace App\Providers;

use App\Console\Commands\AssignVehicleToTrips;
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
    public function boot(): void {
        $this->app->booted(function () {
            $schedule = $this->app->make('Illuminate\Console\Scheduling\Schedule');
            $schedule->command(AssignVehicleToTrips::class)->everyMinute();
        });
    }
}
