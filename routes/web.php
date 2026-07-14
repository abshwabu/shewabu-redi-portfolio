<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndustryController;
use App\Http\Controllers\InsightController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public website routes — Shewabu Redi Mohammed Authorized Accounting Firm
|--------------------------------------------------------------------------
|
| Site architecture (scaffold phase — blank placeholder views):
|  - Home
|  - About the Firm / Our Team
|  - Services hub + dedicated service pages
|  - Industries
|  - Insights
|  - Contact
|  - Legal (Privacy, Terms)
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/about/team', [TeamController::class, 'index'])->name('team');

Route::prefix('services')->name('services.')->group(function () {
    Route::get('/', [ServiceController::class, 'index'])->name('index');
    Route::get('/audit', [ServiceController::class, 'audit'])->name('audit');
    Route::get('/taxation', [ServiceController::class, 'taxation'])->name('taxation');
    Route::get('/accounting', [ServiceController::class, 'accounting'])->name('accounting');
    Route::get('/advisory', [ServiceController::class, 'advisory'])->name('advisory');
    Route::get('/assurance', [ServiceController::class, 'assurance'])->name('assurance');
});

Route::get('/industries', [IndustryController::class, 'index'])->name('industries');
Route::get('/insights', [InsightController::class, 'index'])->name('insights.index');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/terms', [PageController::class, 'terms'])->name('terms');
