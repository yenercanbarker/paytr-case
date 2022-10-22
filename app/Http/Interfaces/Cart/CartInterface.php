<?php

namespace App\Http\Interfaces\Cart;

interface CartInterface
{
    /**
     * @param $request
     * @return mixed
     */
    public function store($request): mixed;

    /**
     * @return mixed
     */
    public function isUserHasNotCompletedCart(): mixed;

    /**
     * @param $id
     * @return mixed
     */
    public function list($id): mixed;

    /**
     * @return mixed
     */
    public function getNonCompletedCartIds(): mixed;

    /**
     * @return mixed
     */
    public function isUserHasNotCompletedCartFirstOrFail(): mixed;

    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update($request, $id): mixed;
}
