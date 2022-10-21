<?php

namespace App\Console\Commands;

use App\Jobs\SyncPropertiesJob;
use Illuminate\Console\Command;

class SyncProperties extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'properties:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync properties in the database with the third party properties api';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        SyncPropertiesJob::dispatch();

        $this->info('Started sync!');

        return Command::SUCCESS;
    }
}
