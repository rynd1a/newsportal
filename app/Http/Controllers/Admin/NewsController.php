<?php

namespace App\Http\Controllers\Admin;

use App\DTO\NewsDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Models\News;
use App\Services\AdminNewsService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    protected AdminNewsService $newsService;

    public function __construct(AdminNewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function index(Request $request): View|RedirectResponse
    {
        $news = $this->newsService->getNewsList($request->sort, $request->published);

        if (!$news) {
            session()->flash('error', 'Не удается получить список новостей');
            return redirect()->route('admin.index');
        }

        $request->flash();

        return view('admin.news.index', compact('news'));
    }

    public function create(): View
    {
        return view('admin.news.create');
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

        return redirect()->route('admin.news.index');
    }

    public function show(News $news): View
    {
        return view('admin.news.show', compact('news'));
    }

    public function edit(News $news): View|RedirectResponse
    {
        return view('admin.news.create', compact('news'));
    }

    public function update(NewsRequest $request, News $news): RedirectResponse
    {
        $newsDTO = new NewsDTO();
        $newsDTO->setHeader($request->header);
        $newsDTO->setAnnounce($request->announce);
        $newsDTO->setDescription($request->description);
        $newsDTO->setImage($request->file('image'));

        $newsUpdated = $this->newsService->updateNews($newsDTO, $news);

        if (!$newsUpdated) {
            session()->flash('error', 'Не удалось сохранить новость. Возможно она была удалена');
            return redirect()->route('admin.news.edit', compact('news'))->withInput();
        }

        return redirect()->route('admin.news.show', $news);
    }

    public function destroy(News $news): RedirectResponse
    {
        if (!$this->newsService->destroyNews($news)) {
            session()->flash('error', 'Не удалось удалить новость. Возможно она была удалена ранее');
        }
        return redirect()->route('admin.news.index');
    }

    public function publish(News $news): RedirectResponse
    {
        if (!$this->newsService->publishNews($news)) {
            session()->flash('error', 'Не удалось сохранить новость. Возможно она была удалена');
        }
        return redirect()->route('admin.news.index');
    }
}
