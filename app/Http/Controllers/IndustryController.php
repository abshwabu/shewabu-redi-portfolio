<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class IndustryController extends Controller
{
    public function index(): View
    {
        return view('industries.index');
    }
}
