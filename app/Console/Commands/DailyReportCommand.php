<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Services\DailyReport;

class DailyReportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gcs:daily-report {action}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Daily Report';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $action = $this->argument('action');

        switch ($action) {
        case 'make':
            echo "Make DailyReport";
            $dailyReport = new DailyReport();
            $dailyReport->generate();
            break;

        case 'send':
            echo "Send DailyReport";
            $dailyReport = new DailyReport();
            $dailyReport->send();
            break;

        default:
            $this->error('Invalid argument: '. $action);
            break;
        }
    }
}
