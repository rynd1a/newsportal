<?php

namespace App\Services;

use App\Models\News;
use Illuminate\Pagination\LengthAwarePaginator;

interface AdminNewsServiceInterface
{
    /**
     * Получение списка новостей с пагинацией и сортировкой
     * @param string|null $sort
     * @param string|null $published
     * @return LengthAwarePaginator|false
     */
    public function getNewsList(?string $sort, ?string $published): LengthAwarePaginator|false;

    /**
     * Удаление новости
     * @param News $news
     * @return bool
     */
    public function destroyNews(News $news): bool;

    /**
     * Публикация новости
     * @param News $news
     * @return bool
     */
    public function publishNews(News $news): bool;
}
