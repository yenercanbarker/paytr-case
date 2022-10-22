<?php

namespace App\Http\Repositories\UserFavorite;

use App\Http\Interfaces\UserFavorite\UserFavoriteInterface;
use App\Models\UserFavorite;

class UserFavoriteRepository implements UserFavoriteInterface
{
    /**
     * User Favorite Instance
     * @var UserFavorite
     */
    private $userFavorite;

    /**
     * User Favorite Repository Constructor
     * @param UserFavorite $_userFavorite
     */
    public function __construct(UserFavorite $_userFavorite)
    {
        $this->userFavorite = $_userFavorite;
    }

    /**
     * User Favorite Repository Store
     * @param $request
     * @return mixed
     */
    public function store($request): mixed
    {
        return $this->userFavorite
            ->firstOrCreate($request);
    }

    /**
     * User Favorite Repository Delete
     * @param $request
     * @return mixed
     */
    public function delete($request): mixed
    {
        return $this->userFavorite
            ->where([
                'user_id' => $request['user_id'],
                'product_id' => $request['product_id'],
            ])
            ->delete();
    }
}
