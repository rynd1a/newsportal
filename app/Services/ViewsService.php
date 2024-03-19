<?php

namespace App\Services;

use App\Jobs\ViewsSenderEmail;
use App\Models\News;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Cookie;

class ViewsService
{
    use DispatchesJobs;

    private int $viewCookieLifeTime;
    private int $viewsForNotification;

    public function __construct()
    {
        $this->viewsForNotification = config('app.viewsForNotification');
        $this->viewCookieLifeTime = config('app.viewCookieLifeTime');
    }

    /**
     * Обработка просмотра новости
     * @param News $news
     * @return void
     */
    public function countViews(News $news): void
    {
        if ($this->setViewedIfNot($news)) {
            $this->checkCountViewsForEmail($news);
        }
    }

    /**
     * Засчитывание просмотра новости, если пользователь смотрит новость впервые
     * @param News $news
     * @return bool
     */
    public function setViewedIfNot(News $news): bool
    {
        if (!Cookie::has('view_' . $news->id)) {
            $news->incrementViews();
            $news->save();
            Cookie::queue('view_' . $news->id, true, $this->viewCookieLifeTime);

            return true;
        }
        return false;
    }

    /**
     * Отправка письма на почту каждое заданное кол-во просмотров
     * @param News $news
     * @return void
     */
    public function checkCountViewsForEmail(News $news): void
    {
        if ($news->views % $this->viewsForNotification === 0) {
            $qs = new ViewsSenderEmail($news);
            $this->dispatch($qs);
        }
    }


}
