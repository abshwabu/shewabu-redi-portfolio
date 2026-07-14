<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class TeamController extends Controller
{
    public function index(): View
    {
        return view('team.index');
    }
}
