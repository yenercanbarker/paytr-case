<?php

namespace App\Http\Interfaces\CartProduct;

interface CartProductInterface
{
    /**
     * @param $request
     * @return mixed
     */
    public function updateOrCreate($request): mixed;

    /**
     * @param $request
     * @return mixed
     */
    public function edit($request): mixed;

    /**
     * @param $request
     * @return mixed
     */
    public function delete($request): mixed;

    /**
     * @param $notCompletedCartIds
     * @param $oldProductVariationId
     * @param $newProductVariationId
     * @return mixed
     */
    public function updateOldProductVariationIdsOnNotCompletedCarts($notCompletedCartIds, $oldProductVariationId, $newProductVariationId): mixed;

    /**
     * @return mixed
     */
    public function getUsedProductVariationIds(): mixed;
}