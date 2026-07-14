<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\View\View;

class FaqController extends Controller
{
    public function index(): View
    {
        $faqs = Faq::query()->published()->ordered()->get();

        $grouped = $faqs->groupBy(fn (Faq $faq) => $faq->category ?: 'General');

        return view('faq.index', [
            'groupedFaqs' => $grouped,
        ]);
    }
}
