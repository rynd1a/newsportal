<?php

namespace App\Services;

use App\DTO\NewsDTO;
use App\Models\News;
use Exception;
use JetBrains\PhpStorm\ArrayShape;

class NewsService implements NewsServiceInterface
{
    protected ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function storeNews(NewsDTO $newsDTO): bool
    {
        try {
            $data = $this->getNewsData($newsDTO);
            $data['user_id'] = $newsDTO->getUserId();

            $news = News::create($data);
            $news->setPublished();

            return true;
        } catch (Exception) {
            return false;
        }
    }

    public function updateNews(NewsDTO $newsDTO, News $news): News|false
    {
        try {
            $data = $this->getNewsData($newsDTO);

            $news->update($data);
            $news->save();

            return $news;
        } catch (Exception) {
            return false;
        }
    }

    #[ArrayShape(['header' => "string", 'announce' => "string", 'description' => "string", 'image_id' => "int|null", 'user_id' => "int"])]
    public function getNewsData(NewsDTO $newsDTO): array
    {
        $data = [
            'header' => $newsDTO->getHeader(),
            'announce' => $newsDTO->getAnnounce(),
            'description' => $newsDTO->getDescription()
        ];

        $image = $newsDTO->getImage();

        if (!is_null($image)) {
            $data['image_id'] = $this->imageService->storeImage($image);
        } else {
            $data['image_id'] = null;
        }
        return $data;
    }
}

