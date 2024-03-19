<?php

namespace App\Services;

use App\DTO\NewsDTO;
use App\Models\News;

interface NewsServiceInterface
{
    /**
     * Создание новую запись новости в БД
     * @param NewsDTO $newsDTO
     * @return bool
     */
    public function storeNews(NewsDTO $newsDTO): bool;

    /**
     * Обновление существующей записи новости в БД
     * @param NewsDTO $newsDTO
     * @param News $news
     * @return News|false
     */
    public function updateNews(NewsDTO $newsDTO, News $news): News|false;

    /**
     * Получение данных новости из DTO
     * @param NewsDTO $newsDTO
     * @return array
     */
    public function getNewsData(NewsDTO $newsDTO): array;
}
