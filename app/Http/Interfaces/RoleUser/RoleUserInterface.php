<?php

namespace App\Http\Interfaces\RoleUser;

interface RoleUserInterface
{
    /**
     * @param $userId
     * @param $roleId
     * @return mixed
     */
    public function store($userId, $roleId): mixed;

    /**
     * @param $userId
     * @return mixed
     */
    public function getUsersRoleByUserId($userId): mixed;
}
