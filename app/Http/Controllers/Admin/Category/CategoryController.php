<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Helpers\RedirectHelper;
use App\Http\Requests\Admin\Category\CategoryStoreRequest;
use App\Http\Requests\Admin\Category\CategoryUpdateRequest;
use App\Http\Resources\Admin\Category\CategoryResource;
use App\Http\Services\Admin\Category\CategoryService;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    /**
     * Category Service Instance
     * @var CategoryService
     */
    private $categoryService;

    /**
     * Category Controller Constructor
     * @param CategoryService $_categoryService
     */
    public function __construct(CategoryService $_categoryService)
    {
        $this->categoryService = $_categoryService;
    }

    /**
     * Category Controller Store
     * @param CategoryStoreRequest $request
     * @return JsonResponse
     */
    public function store(CategoryStoreRequest $request): JsonResponse
    {
        $category = $this->categoryService->store($request->validated());
        if ($category) {
            return RedirectHelper::store([
                'category' => new CategoryResource($category)
            ]);
        }

        return RedirectHelper::error();
    }

    /**
     * Category Controller Index
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return RedirectHelper::customSuccess([
            'categories' => CategoryResource::collection($this->categoryService->list()),
        ]);
    }

    /**
     * Category Controller Edit
     * @param $categoryId
     * @return JsonResponse
     */
    public function edit($categoryId): JsonResponse
    {
        return RedirectHelper::customSuccess([
            'category' => new CategoryResource($this->categoryService->edit($categoryId))
        ]);
    }

    /**
     * Category Controller Destroy
     * @param $categoryId
     * @return JsonResponse
     */
    public function destroy($categoryId): JsonResponse
    {
        if ($this->categoryService->delete($categoryId)) {
            return RedirectHelper::delete([
                'category' => [
                    'id' => $categoryId
                ]
            ]);
        }

        return RedirectHelper::error();
    }

    /**
     * Category Controller Update
     * @param CategoryUpdateRequest $request
     * @param $categoryId
     * @return JsonResponse
     */
    public function update(CategoryUpdateRequest $request, $categoryId): JsonResponse
    {
        if ($this->categoryService->update($request->validated(), $categoryId)) {
            return RedirectHelper::update([
                'category' => new CategoryResource($this->categoryService->edit($categoryId))
            ]);
        }

        return RedirectHelper::error();
    }
}