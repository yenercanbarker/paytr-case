<?php

namespace App\Http\Controllers\Admin\Showcase;

use App\Http\Controllers\Controller;
use App\Http\Helpers\RedirectHelper;
use App\Http\Interfaces\Admin\Product\ProductInterface;
use App\Http\Requests\Admin\Showcase\ShowcaseStoreRequest;
use App\Http\Resources\Admin\Product\ProductListResource;
use App\Http\Services\Admin\Showcase\ShowcaseService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;

class ShowcaseController extends Controller
{
    /**
     * Showcase Service
     * @var ShowcaseService
     */
    private $showcaseService;

    /**
     * Showcase Controller Constructor
     * @param ShowcaseService $_showcaseService
     */
    public function __construct(ShowcaseService $_showcaseService)
    {
        $this->showcaseService = $_showcaseService;
    }

    /**
     * Showcase Controller List
     * @param $showcaseId
     * @return JsonResponse
     */
    public function list($showcaseId): JsonResponse
    {
        return RedirectHelper::customSuccess([
            'showcase_product_list' => $this->showcaseService->list($showcaseId)
        ]);
    }

    /**
     * Showcase Controller Create
     * @return JsonResponse
     * @throws BindingResolutionException
     */
    public function create(): JsonResponse
    {
        return RedirectHelper::customSuccess([
            'products' => ProductListResource::collection(app()->make(ProductInterface::class)->list())
        ]);
    }

    /**
     * Showcase Controller Store
     * @param ShowcaseStoreRequest $request
     * @return JsonResponse
     */
    public function store(ShowcaseStoreRequest $request): JsonResponse
    {
        $showcase = $this->showcaseService->store($request);
        if($showcase) {
            return RedirectHelper::store($this->showcaseService->list($showcase->id));
        }

        return RedirectHelper::error();
    }
}