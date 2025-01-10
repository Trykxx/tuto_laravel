<?php

use App\Http\Controllers\AuthController;
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

    Route::get('/new', 'create')->name('create');
    Route::post('/new', 'store');

    Route::get('/{post}/edit', 'edit')->name('edit');
    Route::post('/{post}/edit', 'update');
});

Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::delete('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('/login', [AuthController::class, 'doLogin']);