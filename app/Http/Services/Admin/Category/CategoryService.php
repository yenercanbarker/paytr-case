<?php

namespace App\Http\Services\Admin\Category;

use App\Http\Interfaces\Admin\Category\CategoryInterface;

class CategoryService
{
    /**
     * Category Repository Instance
     * @var CategoryInterface
     */
    private $categoryRepository;

    /**
     * Category Service Constructor
     * @param CategoryInterface $_categoryRepository
     */
    public function __construct(CategoryInterface $_categoryRepository)
    {
        $this->categoryRepository = $_categoryRepository;
    }

    /**
     * Category Service Store
     * @param $request
     * @return mixed
     */
    public function store($request): mixed
    {
        return $this->categoryRepository->store($request);
    }

    /**
     * Category Service List
     * @return mixed
     */
    public function list(): mixed
    {
        return $this->categoryRepository->list();
    }

    /**
     * Category Service Edit
     * @param $id
     * @return mixed
     */
    public function edit($id): mixed
    {
        return $this->categoryRepository->edit($id);
    }

    /**
     * Category Service Delete
     * @param $id
     * @return mixed
     */
    public function delete($id): mixed
    {
        return $this->categoryRepository->delete($id);
    }

    /**
     * Category Service Update
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update($request, $id): mixed
    {
        return $this->categoryRepository->update($request, $id);
    }
}
