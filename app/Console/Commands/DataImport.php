<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

class DataImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gcs:data-import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Data Import';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $columns = Schema::getColumns('users');
    }
}
