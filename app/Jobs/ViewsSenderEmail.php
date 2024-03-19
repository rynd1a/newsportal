<?php

namespace App\Jobs;

use App\Mail\NewsGotViews;
use App\Models\News;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ViewsSenderEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public News $news;

    public function __construct(News $news)
    {
        $this->news = $news;
    }

    public function handle(): void
    {
        $mail = new NewsGotViews($this->news);
        Mail::to(config('mail.mailers.smtp.username'))->send($mail);
    }
}
