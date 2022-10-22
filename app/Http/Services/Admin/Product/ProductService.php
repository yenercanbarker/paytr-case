<?php

namespace App\Http\Services\Admin\Product;

use App\Http\Interfaces\Admin\Product\ProductInterface;
use App\Http\Interfaces\Admin\ProductVariation\ProductVariationInterface;
use App\Http\Interfaces\CartProduct\CartProductInterface;
use App\Http\Interfaces\Cart\CartInterface;
use Illuminate\Support\Facades\DB;

class ProductService
{
    /**
     * Product Repository Instance
     * @var ProductInterface
     */
    private $productRepository;

    /**
     * Product Variation Repository Instance
     * @var ProductVariationInterface
     */
    private $productVariationRepository;

    /**
     * Product Service Constructor
     * @param ProductInterface $_productRepository
     * @param ProductVariationInterface $_productVariationRepository
     */
    public function __construct(ProductInterface $_productRepository, ProductVariationInterface $_productVariationRepository,)
    {
        $this->productRepository = $_productRepository;
        $this->productVariationRepository = $_productVariationRepository;
    }

    /**
     * Product Service Store
     * @param $request
     * @return mixed
     */
    public function store($request): mixed
    {
        return DB::transaction(function () use ($request) {
            $product = $this->productRepository->store();

            if($product) {
                $productVariationData = [
                    'product_id' => $product->id,
                    'title' => $request['title'],
                    'description' => $request['description'],
                    'price' => $request['price'],
                    'currency_code' => $request['currency_code'],
                    'category_id' => $request['category_id']
                ];

                if(isset($request['discount_percent'])) {
                    $productVariationData['discount_percent'] = $request['discount_percent'];
                }

                $productVariationData = $this->productVariationRepository->store($productVariationData);

                return $product;
            }

            return false;
        });
    }

    /**
     * Product Service List
     * @return mixed
     */
    public function list(): mixed
    {
        return $this->productRepository->list();
    }

    /**
     * Product Service Edit
     * @param $id
     * @return mixed
     */
    public function edit($id): mixed
    {
        $product = $this->productRepository->edit($id);

        return $product;
    }

    /**
     * Product Service Delete
     * @param $id
     * @return mixed
     */
    public function delete($id): mixed
    {
        return DB::transaction(function () use($id) {
            $product = $this->productRepository->edit($id);
            $this->productRepository->deleteWithoutCheck($id);

            return $product->delete();
        });
    }

    /**
     * Product Service Update
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update($request, $id): mixed
    {
        return DB::transaction(function () use($request, $id) {
            $cartProductRepository = app()->make(CartProductInterface::class);
            $product = $this->productRepository->edit($id);

            $productVariationData = [
                'product_id' => $product->product_id,
                'title' => $request['title'],
                'description' => $request['description'],
                'price' => $request['price'],
                'currency_code' => $request['currency_code'],
                'category_id' => $request['category_id']
            ];

            if(isset($request['discount_percent'])) {
                $productVariationData['discount_percent'] = $request['discount_percent'];
            }

            $oldProductVariationId = $product->product_variation_id;
            $nonCompletedCartIds = app()->make(CartInterface::class)->getNonCompletedCartIds();
            $newProductVariation = $this->productVariationRepository->store($productVariationData);
            $cartProductRepository->updateOldProductVariationIdsOnNotCompletedCarts($nonCompletedCartIds, $oldProductVariationId, $newProductVariation->product_variation_id);
            if(!in_array($oldProductVariationId, $cartProductRepository->getUsedProductVariationIds()->toArray())) {
                $this->productVariationRepository->delete($oldProductVariationId);
            }

            return $newProductVariation;
        });
    }
}