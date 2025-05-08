<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Budget;

class ReportController extends Controller
{
    public function daily()
    {
        return view('report-daily')
    }

    public function monthly()
    {
        return view('report-monthly')
    }

    public function budget($id = 1)
    {
        $budgets = Budget::where('project_id', $id)->get();
        $projects = Project::all();

        return view('report-budget', compact('id', 'budgets', 'projects'))
    }
}
