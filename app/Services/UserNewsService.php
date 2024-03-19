<?php

namespace App\Services;

use App\Models\News;
use Exception;
use Illuminate\Database\Query\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class UserNewsService extends NewsService implements UserNewsServiceInterface
{
    protected ViewsService $viewsService;

    public function __construct(ImageService $imageService, ViewsService $viewsService)
    {
        parent::__construct($imageService);
        $this->viewsService = $viewsService;
    }

    public function getNewsList(?string $sort, ?string $search): LengthAwarePaginator|false
    {
        News::query()->when($search, function (Builder $query) use ($search) {
            $query->whereFullText(['header', 'announce', 'description'], $search);
        });


        try {
            return News::search($search)->query(function ($q) use ($sort) {
                return $q->published()->sort($sort);
            })->paginate(config('app.newsPerPage'));
        } catch (Exception) {
            return false;
        }
    }

    public function newsViewed(News $news): bool
    {
        try {
            $this->viewsService->countViews($news);
            return true;
        } catch (Exception) {
            return false;
        }
    }
}
