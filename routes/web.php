<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/hi', function () {
    return view('layouts.master');
});

Route::prefix('admin')->group(function(){
    Route::resource('/posts', PostController::class);
    Route::post('/posts/create', [PostController::class, 'store']);

    Route::get('/posts/search/okok', [PostController::class, 'search'])->name('posts.search');
    Route::resource('/employee', EmployeeController::class);
    Route::post('/employees/create', [EmployeeController::class, 'store']);
    Route::get('/employees/search/okok', [PostController::class, 'search'])->name('employee.search');
    Route::get('/employees/export', [EmployeeController::class, 'export'])->name('employee.export');


});

