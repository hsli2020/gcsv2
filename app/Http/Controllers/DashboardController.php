<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function view($mode = 'full')
    {
        if ($mode == 'full') {
        }

        if ($mode == 'compact') {
        }
    }

    public function sites($type = 'all')
    {
        if ($type == 'all') {
        }

        if ($type == 'gm') {
        }

        if ($type == 'rooftop') {
        }
    }
}
