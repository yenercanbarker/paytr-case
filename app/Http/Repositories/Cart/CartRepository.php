<?php

namespace App\Http\Repositories\Cart;

use App\Http\Enumerations\CartStatusEnum;
use App\Http\Interfaces\Cart\CartInterface;
use App\Models\Cart;

class CartRepository implements CartInterface
{
    /**
     * Cart Instance
     * @var Cart
     */
    private $cart;

    /**
     * Cart Repository Constructor
     * @param Cart $_cart
     */
    public function __construct(Cart $_cart)
    {
        $this->cart = $_cart;
    }

    /**
     * Cart Repository Store
     * @param $request
     * @return mixed
     */
    public function store($request): mixed
    {
        return $this->cart
            ->create($request);
    }

    /**
     * Cart Repository Is User Has Not Completed Cart
     * @return mixed
     */
    public function isUserHasNotCompletedCart(): mixed
    {
        return $this->cart
            ->where([
                'user_id' => auth()->user()->id,
                'status' => CartStatusEnum::NOT_COMPLETED
            ])
            ->first();
    }

    /**
     * Cart Repository Is User Has Not Completed Cart First Or Fail
     * @return mixed
     */
    public function isUserHasNotCompletedCartFirstOrFail(): mixed
    {
        return $this->cart
            ->where([
                'user_id' => auth()->user()->id,
                'status' => CartStatusEnum::NOT_COMPLETED
            ])
            ->firstOrFail();
    }

    /**
     * Cart Repository List
     * @param $id
     * @return mixed
     */
    public function list($id): mixed
    {
        return $this->cart
            ->with(['cartProducts.products.category'])
            ->where('id', $id)
            ->firstOrFail();
    }

    /**
     * Cart Repository Get Non Completed Cart Ids
     * @return mixed
     */
    public function getNonCompletedCartIds(): mixed
    {
        return $this->cart
            ->where([
                'status' => CartStatusEnum::NOT_COMPLETED
            ])
            ->pluck('id');
    }

    /**
     * Cart Repository Update
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update($request, $id): mixed
    {
        return $this->cart
            ->where('id', $id)
            ->update([
                'status' => $request['status']
            ]);
    }
}
