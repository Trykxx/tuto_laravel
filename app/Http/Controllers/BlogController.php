<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogFilterRequest;
use App\Http\Requests\FormPostRequest;
use App\Models\Category;
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

    function create()
    {
        $post = new Post();
        return view('blog.create',[
            'post' => $post
        ]);
    }

    function store(FormPostRequest $request)
    {
        $post = Post::create($request->validated());

        return redirect()->route('blog.show', ['slug' => $post->slug, 'post' => $post->id])->with('success','Le post a été créé !');
    }

    function edit(Post $post)
    {
        return view('blog.edit',[
            'post' => $post
        ]);
    }

    function update(Post $post, FormPostRequest $request)
    {
        $post->update($request->validated());
        return redirect()->route('blog.show', ['slug' => $post->slug, 'post' => $post->id])->with('success','Le post a été modifié !');
    }


}