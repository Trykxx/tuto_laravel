<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/blog')->name('blog.')->group(function(){
    Route::get('/', function () {
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