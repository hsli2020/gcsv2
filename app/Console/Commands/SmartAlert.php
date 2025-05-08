<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SmartAlert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gcs:smart-alert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Smart Alert';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->log(__METHOD__);
    }

    protected function log($str)
    {
        $filename = storage_path('logs/alert.log');
        $str = date('Y-m-d H:i:s ') . $str . "\n";

        echo $str;
        error_log($str, 3, $filename);
    }
}
