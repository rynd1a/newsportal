<?php

namespace App\Services;

use App\Models\News;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserNewsServiceInterface
{
    /**
     * Получение списка новостей с пагинацией и сортировкой
     * @param string|null $sort
     * @param string|null $search
     * @return LengthAwarePaginator|false
     */
    public function getNewsList(?string $sort, ?string $search): LengthAwarePaginator|false;

    /**
     * Новость просмотрена
     * @param News $news
     * @return bool
     */
    public function newsViewed(News $news): bool;
}
