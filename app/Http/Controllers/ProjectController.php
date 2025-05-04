<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index(Request $request, string $id)
    {
        $project = Project::findOrFail($id);
        dd($project);
    }

    public function details(Request $request, string $id)
    {
        dump(__METHOD__);
    }

    public function chart(Request $request, string $id)
    {
        dump(__METHOD__);
    }
}
