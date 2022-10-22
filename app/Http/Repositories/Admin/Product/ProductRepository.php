<?php

namespace App\Http\Repositories\Admin\Product;

use App\Http\Interfaces\Admin\Product\ProductInterface;
use App\Models\ProductVariation;
use App\Models\Product;

class ProductRepository implements ProductInterface
{
    /**
     * Product Instance
     * @var Product
     */
    private $product;

    /**
     * Product Variation
     * @var ProductVariation
     */
    private $productVariation;

    /**
     * Product Repository Constructor
     * @param Product $_product
     * @param ProductVariation $_productVariation
     */
    public function __construct(Product $_product, ProductVariation $_productVariation)
    {
        $this->product = $_product;
        $this->productVariation = $_productVariation;
    }

    /**
     * Product Repository List
     * @return mixed
     */
    public function list(): mixed
    {
        return $this->product
            ->with(['variations' => function ($query) {
                return $query->orderBy('product_variations.product_variation_id', 'ASC');
            }, 'variations.category'])
            ->get();
    }

    /**
     * Product Repository Store
     * @return mixed
     */
    public function store(): mixed
    {
        $product = new $this->product();
        $product->save();

        return $product;
    }

    /**
     * Product Repository Edit
     * @param $id
     * @return mixed
     */
    public function edit($id): mixed
    {
        return $this->productVariation
            ->with(['category', 'product'])
            ->where('product_id', $id)
            ->orderBy('product_variation_id', 'DESC')
            ->firstOrFail();
    }

    /**
     * Product Repository Edit Without Fail
     * @param $id
     * @return mixed
     */
    public function editWithoutFail($id): mixed
    {
        return $this->product
            ->where('id', $id)
            ->first();
    }

    /**
     * Product Repository Delete
     * @param $id
     * @return mixed
     */
    public function delete($id): mixed
    {
        $product = $this->edit($id);

        return $product->delete();
    }

    /**
     * Product Repository Delete Without Check
     * @param $id
     * @return mixed
     */
    public function deleteWithoutCheck($id): mixed
    {
        return $this->product
            ->where('id', $id)
            ->delete();
    }

    /**
     * Product Repository Update
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update($request, $id): mixed
    {
        $product = $this->edit($id);

        return $product->update($request);
    }
}