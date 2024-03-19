<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{
    public function index(): View
    {
        return view('admin.index');
    }

    public function resetSite(): RedirectResponse
    {
        foreach (Cookie::get() as $cookie => $value) if (preg_match('/view_.*/', $cookie)) {
            Cookie::queue(Cookie::forget($cookie));
        }

        foreach (Storage::disk('public')->allDirectories('images') as $directory) {
            Storage::disk('public')->deleteDirectory($directory);
        }

        Artisan::call('migrate:fresh --seed');

        session()->flash('reset', 'Сайт успешно сброшен!');

        return redirect()->route('admin.index');
    }
}
