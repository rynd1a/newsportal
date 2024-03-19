<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(): View|RedirectResponse
    {
        $users = $this->userService->getUsersList();

        if (!$users) {
            session()->flash('error', 'Не удается получить список пользователей');
            return redirect()->route('admin.index');
        }

        return view('admin.users.index', compact('users'));
    }


    public function show(User $user): View|RedirectResponse
    {
        $roles = $this->userService->getOtherRoles($user);

        if (!$roles) {
            session()->flash('error', 'Возникла ошибка');
            return redirect()->route('admin.users.index');
        }

        return view('admin.users.show', compact('user', 'roles'));
    }

    public function destroy(User $user): RedirectResponse
    {
        if (!$this->userService->deleteUser($user)) {
            session()->flash('error', 'Не удалось удалить пользователя. Возможно он был удален ранее');
        }
        return redirect()->route('admin.users.index');
    }

    public function addRole(Request $request, User $user): RedirectResponse
    {
        if ($this->userService->addRole($request->role, $user)) {
            session()->flash('success', 'Роль успешно добавлена');
        } else {
            session()->flash('error', 'Произошла ошибка');
        }
        return redirect()->route('admin.users.show', $user);
    }

    public function removeRole(User $user, Role $role): RedirectResponse
    {
        if (!$this->userService->removeRole($role, $user)) {
            session()->flash('error', 'Произошла ошибка');
        }
        return redirect()->route('admin.users.show', $user);
    }
}
