<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:optimization')]
#[Description('Artisan commands: optimize::clear, optimize')]
class OptimizationCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info("Starting...");

        $this->info("Optimize:clear");
        $configResult = $this->call('optimize:clear');
        if($configResult === self::FAILURE){
            $this->error("Optimize:clear failed");
            return self::FAILURE;
        }

        $this->info("Optimize");
        $configResult = $this->call('optimize');
        if($configResult === self::FAILURE){
            $this->error("Optimize failed");
            return self::FAILURE;
        }

        $this->info('All is done successfully.');
        return self::SUCCESS;
    }
}
