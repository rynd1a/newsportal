<?php

namespace App\Mail;

use App\Models\News;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsGotViews extends Mailable
{
    use Queueable, SerializesModels;

    public News $news;

    public function __construct(News $news)
    {
        $this->news = $news;
    }

    public function build(): NewsGotViews
    {
        return $this->view('email.ten-views');
    }
}
