<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $table = 'monthly_budget';

    //Budget::where('project_id', 1)
    //  ->where('year', 2017)
    //  ->where('month', 1)
    //  ->first();

    // Budget::of(1, 2022, 1)->first()
    protected function scopeOf(Builder $query, $project, $year, $month): void
    {
        $query->where('project_id', $project)
              ->where('year', $year)
              ->where('month', $month);
    }
}
