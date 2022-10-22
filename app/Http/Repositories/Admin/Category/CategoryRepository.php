<?php

namespace App\Http\Repositories\Admin\Category;

use App\Http\Interfaces\Admin\Category\CategoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryInterface
{
    /**
     * Category Instance
     * @var Category
     */
    private $category;

    /**
     * Category Repository Constructor
     * @param Category $_category
     */
    public function __construct(Category $_category)
    {
        $this->category = $_category;
    }

    /**
     * Category Repository List
     * @return mixed
     */
    public function list(): mixed
    {
        return $this->category
            ->get();
    }

    /**
     * Category Repository Store
     * @param $request
     * @return mixed
     */
    public function store($request): mixed
    {
        return $this->category
            ->create($request);
    }

    /**
     * Category Repository Edit
     * @param $id
     * @return mixed
     */
    public function edit($id): mixed
    {
        return $this->category
            ->where('id', $id)
            ->firstOrFail();
    }

    /**
     * Category Repository Delete
     * @param $id
     * @return mixed
     */
    public function delete($id): mixed
    {
        $category = $this->edit($id);

        return $category->delete();
    }

    /**
     * Category Repository Update
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update($request, $id): mixed
    {
        $category = $this->edit($id);

        return $category->update($request);
    }
}
