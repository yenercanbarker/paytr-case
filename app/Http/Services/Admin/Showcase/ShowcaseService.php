<?php

namespace App\Http\Services\Admin\Showcase;

use App\Http\Interfaces\Admin\Product\ProductInterface;
use App\Http\Interfaces\Admin\ProductShowcase\ProductShowcaseInterface;
use App\Http\Interfaces\Admin\Showcase\ShowcaseInterface;
use App\Http\Resources\Admin\Product\ProductListShowcaseResource;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\DB;

class ShowcaseService
{
    /**
     * Showcase Repository Instance
     * @var ShowcaseInterface
     */
    private $showcaseRepository;

    /**
     * Showcase Service Constructor
     * @param ShowcaseInterface $_showcaseRepository
     */
    public function __construct(ShowcaseInterface $_showcaseRepository)
    {
        $this->showcaseRepository = $_showcaseRepository;
    }

    /**
     * Showcase Service List
     * @param $showcaseId
     * @return array
     * @throws BindingResolutionException
     */
    public function list($showcaseId): array
    {
        $orderedProducts = [];
        $favoritedProducts = [];
        $showcase = $this->showcaseRepository->edit($showcaseId);
        $products = app()->make(ProductShowcaseInterface::class)
            ->list($showcaseId);

        foreach ($products as $key => $product) {
            if(isset($product->user_id)) {
                $product->is_favorited = true;
                $favoritedProducts[$key] = $product;
                unset($products[$key]);
            }
        }

        $orderedProducts = $products->sortBy([
            'product.category.title',
            'product.title'
        ]);

        return [
            'showcase' => $showcase,
            'products' => ProductListShowcaseResource::collection(collect($favoritedProducts + $orderedProducts->toArray()))
        ];
    }

    /**
     * Showcase Service Store
     * @param $request
     * @return mixed
     */
    public function store($request): mixed
    {
        return DB::transaction(function () use ($request) {
            $showcase = $this->showcaseRepository->store([
                'title' => $request['title']
            ]);

            if($showcase) {
                foreach ($request['product_id'] as $productId) {
                    $product = app()->make(ProductInterface::class)
                        ->editWithoutFail($productId);

                    if($product) {
                        app()->make(ProductShowcaseInterface::class)
                        ->store([
                            'product_id' => $productId,
                            'showcase_id' => $showcase->id
                        ]);
                    }
                }

                return $showcase;
            }

            return false;
        });
    }
}
