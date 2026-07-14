<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\View\View;

class PageController extends Controller
{
    public function privacy(): View
    {
        return view('pages.privacy', [
            'settings' => SiteSetting::current(),
        ]);
    }

    public function terms(): View
    {
        return view('pages.terms', [
            'settings' => SiteSetting::current(),
        ]);
    }
}
