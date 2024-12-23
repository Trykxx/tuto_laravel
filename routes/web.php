<?php

use App\Http\Controllers\BlogController;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/blog')->name('blog.')->controller(BlogController::class)->group(function(){
    Route::get('/', 'index')->name('index');

    Route::get('/{slug}-{post}', 'show')->where([
        "post" => '[0-9]+',
        "slug" => '[a-zA-Z0-9\-]+'
    ])->name('show');

    // Route::get('/{post:slug}', 'show')->where([
    //     "post" => '[a-zA-Z0-9\-]+'
    // ])->name('show');
});

Route::get('/test', function () {
    return 'Test route working!';
});