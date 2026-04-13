<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    // protected function schedule(Schedule $schedule)
    // {
    //     $schedule->command('schemes:scrape')->daily();

    //     $schedule->command('prices:scrape')->daily();
    // }

    protected function schedule(Schedule $schedule)
{
    // Scrape government schemes every day at 6:00 AM
    $schedule->command('schemes:scrape')->dailyAt('06:00')->withoutOverlapping()->runInBackground();

    // Scrape market prices every day at 7:00 AM
    $schedule->command('prices:scrape')->dailyAt('07:00')->withoutOverlapping()->runInBackground();
}

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
