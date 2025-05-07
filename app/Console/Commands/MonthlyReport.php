<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MonthlyReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gcs:monthly-report {action}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Monthly Report';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $action = $this->argument('action');

        switch ($action) {
        case 'make':
            echo "Make MonthlyReport";
            break;

        case 'send':
            echo "Send MonthlyReport";
            break;

        default:
            $this->error('Invalid argument: '. $action);
            break;
        }
    }
}
