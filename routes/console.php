<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

#php artisan cron:demo
#Schedule::command('cron:demo')->everyTenSeconds();

/*
# Daily Report
Schedule::command('gcs:daily-report make')
    ->dailyAt('23:30');

Schedule::command('gcs:daily-report send')
    ->dailyAt('23:50');

# Monthly Report
Schedule::command('gcs:monthly-report make')
    ->lastDayOfMonth('23:30');
   #->monthlyOn(1, '15:00');

Schedule::command('gcs:monthly-report send')
    ->lastDayOfMonth('23:30');
   #->monthlyOn(1, '15:00');

# Data Import
Schedule::command('gcs:data-import')
    ->everyFiveMinutes();

# Data Archive
Schedule::command('gcs:data-archive')
    ->dailyAt('01:00');

# Smart Alert
Schedule::command('gcs:smart-alert')
    ->everyTenMinutes();
//*/
