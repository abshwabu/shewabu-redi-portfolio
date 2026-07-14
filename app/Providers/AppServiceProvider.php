<?php

namespace App\Providers;

use App\Models\Service;
use App\Models\SiteSetting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useTailwind();

        View::composer('*', function ($view): void {
            if (! array_key_exists('siteSettings', $view->getData())) {
                $view->with('siteSettings', SiteSetting::current());
            }
        });

        View::composer(['layouts.app', 'partials.footer'], function ($view): void {
            $view->with(
                'footerServices',
                Service::query()->published()->ordered()->limit(5)->get()
            );
        });
    }
}
