<?php

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/blog')->name('blog.')->group(function(){
    Route::get('/', function (Post $post) {
        return $post->paginate(25);
    })->name('index');

    Route::get('/{slug}-{id}', function (string $slug, string $id, Post $post) {
        $postFind = $post->findOrFail($id);

        if ($postFind->slug == $slug) {
            return to_route('blog.show', ['slug' => $postFind->slug, 'id'=> $postFind->id]);
        }
        return [
            "slug" => $slug,
            "id" => $id
        ];
    })->where([
        "id" => '[0-9]+',
        "slug" => '[a-z0-9\-]+'
    ])->name('show');
});