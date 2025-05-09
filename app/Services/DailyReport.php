<?php

namespace App\Services;

class DailyReport
{
    public static function make()
    {
        return new self();
    }

    public function generate()
    {
        echo __METHOD__, PHP_EOL;
    }

    public function send()
    {
        echo __METHOD__, PHP_EOL;
    }
}
