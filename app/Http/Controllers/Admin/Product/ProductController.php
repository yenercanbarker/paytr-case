<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Helpers\RedirectHelper;
use App\Http\Interfaces\Admin\Category\CategoryInterface;
use App\Http\Requests\Admin\Product\ProductStoreRequest;
use App\Http\Requests\Admin\Product\ProductUpdateRequest;
use App\Http\Resources\Admin\Product\ProductListResource;
use App\Http\Resources\Admin\Product\ProductResource;
use App\Http\Services\Admin\Product\ProductService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    /**
     * Product Service Instance
     * @var ProductService
     */
    private $productService;

    /**
     * Product Controller Constructor
     * @param ProductService $_productService
     */
    public function __construct(ProductService $_productService)
    {
        $this->productService = $_productService;
    }

    /**
     * Product Controller Create
     * @return JsonResponse
     * @throws BindingResolutionException
     */
    public function create(): JsonResponse
    {
        return RedirectHelper::customSuccess([
            'category_id' => app()->make(CategoryInterface::class)->list()->pluck('title', 'id'),
        ]);
    }

    /**
     * Product Controller Store
     * @param ProductStoreRequest $request
     * @return JsonResponse
     */
    public function store(ProductStoreRequest $request): JsonResponse
    {
        $product = $this->productService->store($request->validated());
        if($product) {
            return RedirectHelper::store([
                'product' => new ProductResource($this->productService->edit($product->id))
            ]);
        }

        return RedirectHelper::error();
    }

    /**
     * Product Controller Index
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return RedirectHelper::customSuccess([
            'products' => ProductListResource::collection($this->productService->list())
        ]);
    }

    /**
     * Product Controller Edit
     * @param $productId
     * @return JsonResponse
     */
    public function edit($productId): JsonResponse
    {
        return RedirectHelper::customSuccess([
            'product' => new ProductResource($this->productService->edit($productId))
        ]);
    }

    /**
     * Product Controller Destroy
     * @param $productId
     * @return JsonResponse
     */
    public function destroy($productId): JsonResponse
    {
        if ($this->productService->delete($productId)) {
            return RedirectHelper::delete([
                'product' => [
                    'id' => $productId
                ]
            ]);
        }

        return RedirectHelper::error();
    }

    /**
     * Product Controller Update
     * @param ProductUpdateRequest $request
     * @param $productId
     * @return JsonResponse
     */
    public function update(ProductUpdateRequest $request, $productId): JsonResponse
    {
        if ($this->productService->update($request->validated(), $productId)) {
            return RedirectHelper::update([
                'product' => new ProductResource($this->productService->edit($productId))
            ]);
        }

        return RedirectHelper::error();
    }
}