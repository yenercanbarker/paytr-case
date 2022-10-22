<?php

namespace App\Http\Repositories\Admin\ProductVariation;

use App\Http\Interfaces\Admin\ProductVariation\ProductVariationInterface;
use App\Models\ProductVariation;

class ProductVariationRepository implements ProductVariationInterface
{
    /**
     * Product Variation Instance
     * @var ProductVariation
     */
    private $productVariation;

    /**
     * Product Variation Repository Constructor
     * @param ProductVariation $_productVariation
     */
    public function __construct(ProductVariation $_productVariation)
    {
        $this->productVariation = $_productVariation;
    }

    /**
     * Product Variation Repository Store
     * @param $request
     * @return mixed
     */
    public function store($request): mixed
    {
        return $this->productVariation
            ->create($request);
    }

    /**
     * Product Variation Repository Edit
     * @param $id
     * @return mixed
     */
    public function edit($id): mixed
    {
        return $this->productVariation
            ->where('product_id', $id)
            ->firstOrFail();
    }

    /**
     * Product Variation Repository Update
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update($request, $id): mixed
    {
        $productVariation = $this->edit($id);

        return $productVariation->update($request);
    }

    /**
     * Product Variation Repository Delete
     * @param $id
     * @return mixed
     */
    public function delete($id): mixed
    {
        return $this->productVariation
            ->where('product_variation_id', $id)
            ->delete();
    }
}
