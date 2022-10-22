<?php

namespace App\Http\Interfaces\UserFavorite;

interface UserFavoriteInterface
{
    /**
     * @param $request
     * @return mixed
     */
    public function store($request): mixed;

    /**
     * @param $request
     * @return mixed
     */
    public function delete($request): mixed;
}
