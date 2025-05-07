<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DataArchive extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gcs:data-archive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Data Archive';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
    }
}
