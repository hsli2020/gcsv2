<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Snapshot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gcs:snapshot';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Snapshot';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
    }
}
