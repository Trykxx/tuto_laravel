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

class BlogController extends Controller
{
    public function index(Post $post, BlogFilterRequest $request): View
    {
        dd($request->validated());

        $posts = $post->paginate(1);
        return view('blog.index', [
            'posts' => $posts
        ]);
    }

    public function show(string $slug, string $id, Post $post): View | RedirectResponse
    {
        $postFind = $post->findOrFail($id);

        // Si le slug ne correspond pas, on redirige vers la bonne URL.
        if ($postFind->slug !== $slug) {
            return to_route('blog.show', ['slug' => $postFind->slug, 'id' => $postFind->id]);
        }

        // Sinon, on retourne le post trouvé.
        return view('blog.show', [
            'post' => $postFind
        ]);
    }

    function create()
    {
        
    }
}
