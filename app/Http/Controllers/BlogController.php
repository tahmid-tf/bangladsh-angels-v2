<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));
        $category = trim((string) $request->query('category', ''));

        $blogs = Blog::query()
            ->published()
            ->when($search !== '', function (Builder $query) use ($search): void {
                $query->where(function (Builder $query) use ($search): void {
                    $query->where('title', 'like', '%'.$search.'%')
                        ->orWhere('excerpt', 'like', '%'.$search.'%')
                        ->orWhere('content', 'like', '%'.$search.'%');
                });
            })
            ->when($category !== '', fn (Builder $query) => $query->where('category', $category))
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->paginate(8)
            ->withQueryString();

        return view('blogs.index', [
            'blogs' => $blogs,
            'categories' => $this->categories(),
            'recentBlogs' => $this->recentBlogs(),
            'search' => $search,
            'selectedCategory' => $category,
        ]);
    }

    public function show(string $slug): View
    {
        $blog = Blog::query()->published()->where('slug', $slug)->firstOrFail();

        return view('blogs.show', [
            'blog' => $blog,
            'categories' => $this->categories(),
            'recentBlogs' => $this->recentBlogs($blog->id),
        ]);
    }

    private function categories()
    {
        return Blog::query()
            ->published()
            ->selectRaw('category, COUNT(*) as posts_count')
            ->groupBy('category')
            ->orderBy('category')
            ->get();
    }

    private function recentBlogs(?int $exceptId = null)
    {
        return Blog::query()
            ->published()
            ->when($exceptId !== null, fn (Builder $query) => $query->whereKeyNot($exceptId))
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->limit(5)
            ->get();
    }
}
