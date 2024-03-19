<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserServiceInterface
{
    /**
     * Получение списка пользователей
     * @return LengthAwarePaginator|false
     */
    public function getUsersList(): LengthAwarePaginator|false;

    /**
     * Получение ролей, которых нет у пользователя
     * @param User $user
     * @return Collection|false
     */
    public function getOtherRoles(User $user): Collection|false;

    /**
     * Удаление пользователя
     * @param User $user
     * @return bool
     */
    public function deleteUser(User $user): bool;

    /**
     * Добавление роли пользователю
     * @param int|null $roleId
     * @param User $user
     * @return bool
     */
    public function addRole (?int $roleId, User $user): bool;

    /**
     * Удаление роли у пользователя
     * @param Role $role
     * @param User $user
     * @return bool
     */
    public function removeRole(Role $role, User $user): bool;

    /**
     * Получение списка новостей, предложенных пользователем
     * @param User $user
     * @param string|null $sort
     * @return LengthAwarePaginator|false
     */
    public function getUsersNewsList(User $user, ?string $sort): LengthAwarePaginator|false;
}
