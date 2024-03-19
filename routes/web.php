<?php

use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group([
    'middleware' => 'auth'
], function () {
    Route::get('/', [NewsController::class, 'index'])->name('news.index')->withoutMiddleware('auth');
    Route::resource('news', NewsController::class)->except('destroy', 'show', 'index');
    Route::get('news/{news}', [NewsController::class, 'show'])->name('news.show')->withoutMiddleware('auth');

    Route::get('profile/{user}/news', [ProfileController::class, 'news'])->name('profile.news');
    Route::get('profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
});

Route::group([
    'middleware' => 'admin',
    'prefix' => 'admin',
    'as' => 'admin.'
], function () {
    Route::get('', [App\Http\Controllers\Admin\MainController::class, 'index'])->name('index');
    Route::get('reset-site', [App\Http\Controllers\Admin\MainController::class, 'resetSite'])->name('reset-site');

    Route::resource('news', \App\Http\Controllers\Admin\NewsController::class);
    Route::get('publish/{news}', [\App\Http\Controllers\Admin\NewsController::class, 'publish'])->name('news.publish');


    Route::resource('users', UsersController::class)->only('index', 'show', 'destroy');
    Route::post('users/{user}/add-role', [UsersController::class, 'addRole'])->name('users.add-role');
    Route::post('users/{user}/remove-role/{role}', [UsersController::class, 'removeRole'])->name('users.remove-role');
});

