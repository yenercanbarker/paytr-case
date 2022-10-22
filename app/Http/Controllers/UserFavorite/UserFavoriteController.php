<?php

namespace App\Http\Controllers\UserFavorite;

use App\Http\Controllers\Controller;
use App\Http\Helpers\RedirectHelper;
use App\Http\Requests\UserFavorite\AddToFavoritesRequest;
use App\Http\Requests\UserFavorite\RemoveFromFavoritesRequest;
use App\Http\Services\UserFavorite\UserFavoriteService;
use Illuminate\Http\JsonResponse;

class UserFavoriteController extends Controller
{
    /**
     * User Favorite Service
     * @var UserFavoriteService
     */
    private $userFavoriteService;

    /**
     * User Favorite Controller Constructor
     * @param UserFavoriteService $_userFavoriteService
     */
    public function __construct(UserFavoriteService $_userFavoriteService)
    {
        $this->userFavoriteService = $_userFavoriteService;
    }

    /**
     * User Favorite Controller Add To Favorites
     * @param AddToFavoritesRequest $request
     * @return JsonResponse
     */
    public function addToFavorites(AddToFavoritesRequest $request): JsonResponse
    {
        if($this->userFavoriteService->addToFavorites($request->validated())) {
            return RedirectHelper::customSuccess([
                'user_favorite' => [
                    'user_id' => auth()->user()->id,
                    'product_id' => $request['product_id'],
                ]
            ]);
        }

        return RedirectHelper::error();
    }

    /**
     * User Favorite Controller Remove From Favorites
     * @param RemoveFromFavoritesRequest $request
     * @return JsonResponse
     */
    public function removeFromFavorites(RemoveFromFavoritesRequest $request): JsonResponse 
    {
        if($this->userFavoriteService->removeFromFavorites($request->validated())) {
            return RedirectHelper::customSuccess([
                'user_favorite' => [
                    'user_id' => auth()->user()->id,
                    'product_id' => $request['product_id'],
                ]
            ]);
        }

        return RedirectHelper::error();
    }
}