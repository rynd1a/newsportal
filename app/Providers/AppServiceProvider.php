<?php

namespace App\Providers;

use App\Models\News;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {

        Blade::if('newsExist', function () {
            return News::all()->count() > 0;
        });

        Blade::if('isAdmin', function () {
            return Auth::check() && Auth::user()->isAdmin();
        });

        Blade::if('canUpdateNews', function ($news) {
            if (Auth::check() && (Auth::user()->isAdmin() || Auth::user()->id === $news->user->id)) {
                return true;
            }
            return false;

        });

        Paginator::useBootstrap();

        Gate::define('update-news', function (User $user, News $news) {
            return $user->isAdmin() || $user->id === $news->user->id;
        });

        Gate::define('update-profile', function (User $user) {
            return Auth::user()->id === $user->id;
        });
    }
}
