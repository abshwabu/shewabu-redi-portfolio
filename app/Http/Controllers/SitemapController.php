<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Service;
use App\Models\TeamMember;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $urls = collect([
            ['loc' => route('home'), 'changefreq' => 'weekly', 'priority' => '1.0'],
            ['loc' => route('about'), 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['loc' => route('team.index'), 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['loc' => route('services.index'), 'changefreq' => 'weekly', 'priority' => '0.9'],
            ['loc' => route('industries'), 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => route('insights.index'), 'changefreq' => 'weekly', 'priority' => '0.8'],
            ['loc' => route('faq'), 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => route('contact'), 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['loc' => route('privacy'), 'changefreq' => 'yearly', 'priority' => '0.3'],
            ['loc' => route('terms'), 'changefreq' => 'yearly', 'priority' => '0.3'],
        ]);

        TeamMember::query()->published()->ordered()->get()->each(function ($member) use ($urls): void {
            $urls->push([
                'loc' => route('team.show', $member),
                'changefreq' => 'monthly',
                'priority' => '0.6',
            ]);
        });

        Service::query()->published()->ordered()->get()->each(function ($service) use ($urls): void {
            $urls->push([
                'loc' => route('services.show', $service),
                'changefreq' => 'monthly',
                'priority' => '0.8',
            ]);
        });

        Post::query()->published()->orderByDesc('published_at')->get()->each(function ($post) use ($urls): void {
            $urls->push([
                'loc' => route('insights.show', $post),
                'changefreq' => 'monthly',
                'priority' => '0.7',
                'lastmod' => $post->updated_at?->toAtomString(),
            ]);
        });

        $xml = view('sitemap', ['urls' => $urls])->render();

        return response($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
    }
}
