<?php

namespace App\Http\Repositories\RoleUser;

use App\Http\Interfaces\RoleUser\RoleUserInterface;
use App\Models\RoleUser;

class RoleUserRepository implements RoleUserInterface
{
    /**
     * Role User Instance
     * @var RoleUser
     */
    private $roleUser;

    /**
     * Role User Constructor
     * @param RoleUser $_roleUser
     */
    public function __construct(RoleUser $_roleUser)
    {
        $this->roleUser = $_roleUser;
    }

    /**
     * Role User Store
     * @param $userId
     * @param $roleId
     * @return mixed
     */
    public function store($userId, $roleId): mixed
    {
        return $this->roleUser
            ->create([
                'user_id' => $userId,
                'role_id' => $roleId
            ]);
    }

    /**
     * Role User Get Users Role By User Id
     * @param $userId
     * @return mixed
     */
    public function getUsersRoleByUserId($userId): mixed
    {
        return $this->roleUser
            ->where([
                'user_id' => $userId
            ])
            ->first();
    }
}
