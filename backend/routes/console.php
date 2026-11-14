<?php

use App\Console\Commands\OptimizationCommand;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('log:clear', function () {
    // This command clears all log files older than 7 days from the storage/logs directory.
    foreach (Storage::disk('logs')->files() as $file) {
        if (Storage::disk('logs')->exists($file) && Storage::disk('logs')->lastModified($file) < now()->subDays(7)->timestamp) {
            Storage::disk('logs')->delete($file);
        }
    }

    $this->info('Logs cleared successfully.');
})->purpose('Clear application logs')->weekly();

Schedule::command(OptimizationCommand::class)->daily();


