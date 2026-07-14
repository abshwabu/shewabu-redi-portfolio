<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use App\Models\TeamMember;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function index(): View
    {
        return view('about.index', [
            'settings' => SiteSetting::current(),
            'teamPreview' => TeamMember::query()
                ->published()
                ->ordered()
                ->limit(4)
                ->get(),
        ]);
    }
}
