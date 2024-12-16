<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/blog', function(Request $request){
    return [
        "name" => $request->get('name'),
        "article" => "Article 1"
    ];
});