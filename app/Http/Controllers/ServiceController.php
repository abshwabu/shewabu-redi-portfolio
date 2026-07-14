<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        return view('services.index');
    }

    public function audit(): View
    {
        return view('services.audit');
    }

    public function taxation(): View
    {
        return view('services.taxation');
    }

    public function accounting(): View
    {
        return view('services.accounting');
    }

    public function advisory(): View
    {
        return view('services.advisory');
    }

    public function assurance(): View
    {
        return view('services.assurance');
    }
}
