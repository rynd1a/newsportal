<?php

namespace App\View\Composers;

use App\Models\News;
use App\Models\User;
use Illuminate\View\View;

class AdminComposer
{
    public function compose(View $view): void
    {
        $view->with('usersCount', User::all()->count());
        $view->with('lastUser', User::latest()->first());
        $view->with('newsCount', News::all()->count());
        $view->with('lastNews', News::latest()->first());
    }
}
