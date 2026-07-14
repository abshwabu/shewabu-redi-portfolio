<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\TeamMember;
use App\Models\Testimonial;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $settings = SiteSetting::current();

        return view('home.index', [
            'settings' => $settings,
            'featuredServices' => Service::query()
                ->published()
                ->where('is_featured', true)
                ->ordered()
                ->limit(6)
                ->get(),
            'testimonials' => Testimonial::query()
                ->published()
                ->where('is_featured', true)
                ->ordered()
                ->get(),
            'stats' => $settings->stats(),
        ]);
    }
}
