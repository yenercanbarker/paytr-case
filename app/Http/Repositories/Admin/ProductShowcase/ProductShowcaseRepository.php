<?php

namespace App\Http\Repositories\Admin\ProductShowcase;

use App\Http\Interfaces\Admin\ProductShowcase\ProductShowcaseInterface;
use App\Models\ProductShowcase;

class ProductShowcaseRepository implements ProductShowcaseInterface
{
    /**
     * Product Showcase Instance
     * @var ProductShowcase
     */
    private $productShowcase;

    /**
     * Product Showcase Repository Constructor
     * @param ProductShowcase $_productShowcase
     */
    public function __construct(ProductShowcase $_productShowcase)
    {
        $this->productShowcase = $_productShowcase;
    }

    /**
     * Product Showcase Store
     * @param $request
     * @return mixed
     */
    public function store($request): mixed
    {
        return $this->productShowcase
            ->create($request);
    }

    /**
     * Product Showcase Repository Constructor
     * @param $showcaseId
     * @return mixed
     */
    public function list($showcaseId): mixed
    {
        return $this->productShowcase
            ->orderByRaw("user_favorites.product_id DESC")
            ->leftJoin('user_favorites', 'user_favorites.product_id', '=', 'product_showcases.product_id')
            ->select('user_favorites.user_id', 'showcase_id', 'product_showcases.product_id')
            ->where([
                'showcase_id' => $showcaseId
            ])
            ->with(['product', 'product.category'])
            ->get();
    }
}
