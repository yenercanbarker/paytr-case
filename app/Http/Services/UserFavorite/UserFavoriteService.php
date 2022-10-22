<?php

namespace App\Http\Services\UserFavorite;

use App\Http\Interfaces\UserFavorite\UserFavoriteInterface;

class UserFavoriteService
{
    /**
     * User Favorite Instance
     * @var UserFavoriteInterface
     */
    private $userFavoriteRepository;

    /**
     * User Favorite Service Constructor
     * @param UserFavoriteInterface $_userFavoriteRepository
     */
    public function __construct(UserFavoriteInterface $_userFavoriteRepository)
    {
        $this->userFavoriteRepository = $_userFavoriteRepository;
    }

    /**
     * User Favorite Service Add To Favorites
     * @param $request
     * @return mixed
     */
    public function addToFavorites($request): mixed
    {
        $request['user_id'] = auth()->user()->id;

        return $this->userFavoriteRepository->store($request);
    }

    /**
     * User Favorite Service Remove From Favorites
     * @param $request
     * @return mixed
     */
    public function removeFromFavorites($request): mixed
    {
        $request['user_id'] = auth()->user()->id;

        return $this->userFavoriteRepository->delete($request);
    }
}
