<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageUploadController;



Route::get('/', function () {
    return view('welcome');
});


// nếu không thông qua controller thì trả về view 
Route::get('/hi', function () {
    return view('layouts.master');
});

// Route::get('/table', function () {
//     return view('table.index');
// })\;
// route::get('/dashboard', [PostController::class, 'index']);
Route::resource('/posts', PostController::class);
Route::post('/posts/create', [PostController::class, 'store']);



