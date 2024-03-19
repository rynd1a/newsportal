<?php

namespace App\Providers;

use App\View\Composers\AdminComposer;
use App\View\Composers\NewsComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        View::composer('*', NewsComposer::class);

        View::composer('admin.index', AdminComposer::class);
    }
}
