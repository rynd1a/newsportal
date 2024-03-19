<?php

namespace App\View\Composers;

use App\Models\News;
use Illuminate\View\View;

class NewsComposer
{
    public function compose(View $view): void
    {
        $lastNews = News::latest()->first();
        $view->with('lastNewsCreated', $lastNews ? $lastNews->created_at : null);
    }
}
