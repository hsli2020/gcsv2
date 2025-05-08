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
        $this->log(__METHOD__);
    }

    protected function log($str)
    {
        $today = date('Y-m-d');
        $filename = storage_path("logs/import-$today.log");

       #if (file_exists($filename) && filesize($filename) > 1024*1024) {
       #    unlink($filename);
       #}

        $str = date('Y-m-d H:i:s ') . $str . "\n";

        echo $str;
        error_log($str, 3, $filename);
    }
}
