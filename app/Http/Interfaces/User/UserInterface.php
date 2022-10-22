<?php

namespace App\Http\Interfaces\User;

interface UserInterface
{
    /**
     * @param $request
     * @return mixed
     */
    public function store($request): mixed;

    /**
     * @param $email
     * @param $password
     * @return mixed
     */
    public function findUserByUsernameAndPassword($email, $password): mixed;
}
