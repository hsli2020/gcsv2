<?php

namespace App\Services;

class SmartAlert
{
    public static function make()
    {
        return new self();
    }

    protected function log($str)
    {
        $filename = storage_path('logs/alert.log');
        $str = date('Y-m-d H:i:s ') . $str . "\n";

        echo $str;
        error_log($str, 3, $filename);
    }
}
