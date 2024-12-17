<?php

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/blog')->name('blog.')->group(function(){
    Route::get('/', function () {

        $post = new Post();

        $post->title = "Mon second article";
        $post->slug = "Mon-second-article";
        $post->content = 'Mon contenu';

        $post->save();

        return $post;

        return [
            "link" => \route('blog.show', ['slug' => 'article', 'id'=> 15])
        ];
    })->name('index');

    Route::get('/{slug}-{id}', function (string $slug, string $id) {
        return [
            "slug" => $slug,
            "id" => $id
        ];
    })->where([
        "id" => '[0-9]+',
        "slug" => '[a-z0-9\-]+'
    ])->name('show');
});