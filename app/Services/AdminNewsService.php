<?php

namespace App\Services;

use App\Models\News;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;

class AdminNewsService extends NewsService implements AdminNewsServiceInterface
{
    public function getNewsList(?string $sort, ?string $published): LengthAwarePaginator|false
    {
        try {
            $news = News::sort($sort, $published);
        } catch (Exception) {
            return false;
        }

        return $news->paginate(config('app.adminNewsPerPage'));
    }

    public function destroyNews(News $news): bool
    {
        try {
            $news->delete();
            return true;
        } catch (Exception) {
            return false;
        }
    }

    public function publishNews(News $news): bool
    {
        try {
            $news->setPublished();
            return true;
        } catch (Exception) {
            return false;
        }
    }
}
