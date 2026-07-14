<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        return view('services.index', [
            'services' => Service::query()->published()->ordered()->get(),
        ]);
    }

    public function show(Service $service): View
    {
        abort_unless($service->status === \App\Enums\ContentStatus::Published, 404);

        $related = Service::query()
            ->published()
            ->whereKeyNot($service->id)
            ->when(
                filled($service->category),
                fn ($query) => $query->where('category', $service->category)
            )
            ->ordered()
            ->limit(3)
            ->get();

        if ($related->count() < 3) {
            $extra = Service::query()
                ->published()
                ->whereKeyNot($service->id)
                ->whereNotIn('id', $related->pluck('id'))
                ->ordered()
                ->limit(3 - $related->count())
                ->get();

            $related = $related->concat($extra);
        }

        return view('services.show', [
            'service' => $service,
            'relatedServices' => $related,
        ]);
    }
}
