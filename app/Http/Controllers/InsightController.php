<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class InsightController extends Controller
{
    public function index(): View
    {
        return view('insights.index');
    }
}
