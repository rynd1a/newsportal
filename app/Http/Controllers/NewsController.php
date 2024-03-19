<?php

namespace App\Http\Controllers;

use App\DTO\NewsDTO;
use App\Http\Requests\NewsRequest;
use App\Models\News;
use App\Services\UserNewsService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;

class NewsController extends Controller
{
    protected UserNewsService $newsService;

    public function __construct(UserNewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function index(Request $request): View
    {
        $news = $this->newsService->getNewsList($request->sort, $request->search);

        if (!$news) {
            session()->flash('error', 'Не удается получить список новостей');
        }

        $request->flash();

        return view('news.index', compact('news'));
    }

    public function create(): View
    {
        return view('news.create');
    }

    public function store(NewsRequest $request): RedirectResponse
    {
        $newsDTO = new NewsDTO();
        $newsDTO->setHeader($request->header);
        $newsDTO->setAnnounce($request->announce);
        $newsDTO->setDescription($request->description);
        $newsDTO->setUserId(Auth::user()->id);
        $newsDTO->setImage($request->file('image'));

        if (!$this->newsService->storeNews($newsDTO)) {
            session()->flash('error', 'Не удалось сохранить новость. Попробуйте позже');
            return redirect()->back()->withInput();
        }

        return redirect()->route('index');
    }

    public function show(News $news): View|RedirectResponse
    {
        if (!$this->newsService->newsViewed($news)) {
            return redirect()->back();
        }

        return view('news.show', compact('news'));
    }

    public function edit(News $news): View|RedirectResponse
    {
        if (Gate::allows('update-news', $news)) {
            return view('news.create', compact('news'));
        }
        return redirect()->route('news.show', $news);
    }

    public function update(NewsRequest $request, News $news): RedirectResponse
    {
        if (Gate::allows('update-news', $news)) {
            $newsDTO = new NewsDTO();
            $newsDTO->setHeader($request->header);
            $newsDTO->setAnnounce($request->announce);
            $newsDTO->setDescription($request->description);
            $newsDTO->setImage($request->file('image'));

            $newsUpdated = $this->newsService->updateNews($newsDTO, $news);

            if (!$newsUpdated) {
                session()->flash('error', 'Не удалось сохранить новость. Возможно она была удалена');
                return redirect()->route('news.edit', compact('news'))->withInput();
            }
        }
        return redirect()->route('news.show', $news);
    }
}
