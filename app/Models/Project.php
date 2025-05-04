<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public $timestamps = false;

    public function devices()
    {
        return $this->hasMany(Device::class);
    }

    public function inverters()
    {
        return $this->hasMany(Inverter::class);
    }

    public function genmeters()
    {
        return $this->hasMany(GenMeter::class);
    }

    public function envkits()
    {
        return $this->hasMany(EnvKit::class);
    }
}
