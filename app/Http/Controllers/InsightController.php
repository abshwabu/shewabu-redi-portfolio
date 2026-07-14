<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;

class InsightController extends Controller
{
    public function index(): View
    {
        $posts = Post::query()
            ->with('author')
            ->published()
            ->orderByDesc('published_at')
            ->paginate(9);

        return view('insights.index', [
            'posts' => $posts,
        ]);
    }

    public function show(Post $post): View
    {
        abort_unless(
            $post->status === \App\Enums\PostStatus::Published
            && $post->published_at
            && $post->published_at->lte(now()),
            404
        );

        $post->load('author');

        $related = Post::query()
            ->published()
            ->whereKeyNot($post->id)
            ->when(
                filled($post->category),
                fn ($query) => $query->where('category', $post->category)
            )
            ->orderByDesc('published_at')
            ->limit(3)
            ->get();

        if ($related->count() < 3) {
            $extra = Post::query()
                ->published()
                ->whereKeyNot($post->id)
                ->whereNotIn('id', $related->pluck('id'))
                ->orderByDesc('published_at')
                ->limit(3 - $related->count())
                ->get();

            $related = $related->concat($extra);
        }

        return view('insights.show', [
            'post' => $post,
            'relatedPosts' => $related,
        ]);
    }
}
