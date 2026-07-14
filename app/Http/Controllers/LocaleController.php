<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
  public function switch(Request $request, string $locale): RedirectResponse
  {
    if (! in_array($locale, ['en', 'am'], true)) {
      abort(404);
    }

    session(['locale' => $locale]);

    return back();
  }

    public function toggle(Request $request): RedirectResponse|\Illuminate\Http\JsonResponse
    {
        $next = app()->getLocale() === 'am' ? 'en' : 'am';

        session(['locale' => $next]);

        if ($request->expectsJson()) {
            return response()->json(['locale' => $next]);
        }

        return back();
    }
}
