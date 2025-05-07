<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SnowWiper;

class SnowWiperController extends Controller
{
    public function getState()
    {
        $wiper = new SnowWiper();
        return $wiper->getState();
    }

    public function turnOn()
    {
        $wiper = new SnowWiper();
        return $wiper->turnOn();
    }

    public function turnOff()
    {
        $wiper = new SnowWiper();
        return $wiper->turnOff();
    }

    public function pulse()
    {
        $wiper = new SnowWiper();
        return $wiper->pulse();
    }

    public function autoPulse($state = 0)
    {
        $filename = storage_path('autopulse.ini');
        file_put_contents($filename, "state=$state");
        return [ 'autopulse' => $state ];
    }
}
