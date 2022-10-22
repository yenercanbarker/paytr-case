<?php

namespace App\Http\Repositories\CartProduct;

use App\Http\Interfaces\CartProduct\CartProductInterface;
use App\Models\CartProduct;

class CartProductRepository implements CartProductInterface
{
    /**
     * Cart Product Instance
     * @var CartProduct
     */
    private $cartProduct;

    /**
     * Cart Product Repository Constructor
     * @param CartProduct $_cartProduct
     */
    public function __construct(CartProduct $_cartProduct)
    {
        $this->cartProduct = $_cartProduct;
    }

    /**
     * Cart Product Repository Update Or Create
     * @param $request
     * @return mixed
     */
    public function updateOrCreate($request): mixed
    {
        return $this->cartProduct
            ->updateOrCreate(
                [
                    'product_variation_id' => $request['product_variation_id'],
                    'cart_id' => $request['cart_id']
                ],
                [
                    'count' => $request['count']
                ]
            );
    }

    /**
     * Cart Product Repository Edit
     * @param $request
     * @return mixed
     */
    public function edit($request): mixed
    {
        return $this->cartProduct
            ->where([
                'cart_id' => $request['cart_id'],
                'product_variation_id' => $request['product_variation_id']
            ])
            ->firstOrFail();
    }

    /**
     * Cart Product Repository Delete
     * @param $request
     * @return mixed
     */
    public function delete($request): mixed
    {
        $cartProduct = $this->edit($request);

        return $cartProduct->delete();
    }

    /**
     * Cart Product Repository Update Old Product Variation Ids On Non Completed Carts
     * @param $notCompletedCartIds
     * @param $oldProductVariationId
     * @param $newProductVariationId
     * @return mixed
     */
    public function updateOldProductVariationIdsOnNotCompletedCarts($notCompletedCartIds, $oldProductVariationId, $newProductVariationId): mixed
    {
        return $this->cartProduct
            ->where([
                'product_variation_id' => $oldProductVariationId
            ])
            ->whereIn('cart_id', $notCompletedCartIds)
            ->update([
                'product_variation_id' => $newProductVariationId
            ]);
    }

    /**
     * Cart Repository Get Used Product Variations Ids
     * @return mixed
     */
    public function getUsedProductVariationIds(): mixed
    {
        return $this->cartProduct
            ->pluck('product_variation_id');
    }
}