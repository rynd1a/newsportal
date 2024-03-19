<?php

namespace App\Services;

use App\Models\News;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService implements UserServiceInterface
{
    public function getUsersList(): LengthAwarePaginator|false
    {
        try {
            return User::paginate(config('app.adminUsersPerPage'));
        } catch (Exception) {
            return false;
        }
    }

    public function getOtherRoles(User $user): Collection|false
    {
        try {
            return Role::all()->whereNotIn('id', $user->roles()->pluck('roles.id')->toArray());
        } catch (Exception) {
            return false;
        }
    }

    public function deleteUser(User $user): bool
    {
        try {
            $user->delete();
            return true;
        } catch (Exception) {
            return false;
        }
    }

    public function addRole (?int $roleId, User $user): bool
    {
        if (is_null($roleId)) return false;
        $role = Role::find($roleId);
        if (is_null($role)) return false;
        $role->users()->save($user);
        return true;
    }

    public function removeRole(Role $role, User $user): bool
    {
        try {
            $role->users()->detach($user);
            return true;
        } catch (Exception) {
            return false;
        }
    }

    public function getUsersNewsList(User $user, ?string $sort): LengthAwarePaginator|false
    {
        try {
            return News::published()->sort($sort)->where('user_id', $user->id)->paginate(config('app.newsPerPage'));
        } catch (Exception) {
            return false;
        }
    }
}
