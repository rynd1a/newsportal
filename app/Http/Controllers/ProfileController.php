<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function show(User $user): View
    {
        return view('auth.profile.index', compact('user'));
    }

    public function news(Request $request, User $user): View|RedirectResponse
    {
        $news = $this->userService->getUsersNewsList($user, $request->sort);

        if (!$news) {
            return redirect()->back();
        }

        $request->flash();

        return view('auth.profile.news', compact('user', 'news'));
    }
}
