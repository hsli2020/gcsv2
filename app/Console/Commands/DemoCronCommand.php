<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

use App\Mail\SmartAlertMail;
use App\Mail\DailyReportMail;
use App\Mail\MonthlyReportMail;

class DemoCronCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:demo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info(__CLASS__. " Job Running At ". now());

        Mail::to('lihsca@gmail.com')->send(new SmartAlertMail());
        Mail::to('lihsca@gmail.com')->send(new DailyReportMail());
        Mail::to('lihsca@gmail.com')->send(new MonthlyReportMail());
    }
}
