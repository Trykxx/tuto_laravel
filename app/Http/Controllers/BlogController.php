<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogFilterRequest;
use App\Models\Post;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index(): View
    {
        return view('blog.index', [
            'posts' => Post::paginate(1)
        ]);
    }

    public function show(string $slug, Post $post): View | RedirectResponse
    {
        // Si le slug ne correspond pas, on redirige vers la bonne URL.
        if ($post->slug !== $slug) {
            return to_route('blog.show', ['slug' => $post->slug, 'id' => $post->id]);
        }

        // Sinon, on retourne le post trouvé.
        return view('blog.show', [
            'post' => $post
        ]);
    }

    public function create()
    {
        return view('blog.create');
    }

    public function store(Request $request)
    {
        $post = Post::create([
            'title' => $request->input('title'),
            'content' => $request->input(),
            'slug' => Str::slug($request->input('title'))
        ]);
        return redirect()->route('blog.show', ['slug' => $post->slug, 'post' => $post->id]);
    }


}
