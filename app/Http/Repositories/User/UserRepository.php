<?php

namespace App\Http\Repositories\User;

use App\Http\Interfaces\User\UserInterface;
use App\Models\User;

class UserRepository implements UserInterface
{
    /**
     * User Instance
     * @var User
     */
    private $user;

    /**
     * User Repository Constructor
     * @param User $_user
     */
    public function __construct(User $_user)
    {
        $this->user = $_user;
    }

    /**
     * User Repository Find User By Username And Password
     * @param $username
     * @param $password
     * @return mixed
     */
    public function findUserByUsernameAndPassword($username, $password): mixed
    {
        return $this->user
            ->where([
                'name' => $username,
                'password' => $password
            ])
            ->firstOrFail();
    }

    /**
     * User Repository Store
     * @param $request
     * @return mixed
     */
    public function store($request): mixed
    {
        return $this->user
            ->create($request);
    }
}
