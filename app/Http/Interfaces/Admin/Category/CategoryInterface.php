<?php

namespace App\Http\Interfaces\Admin\Category;

interface CategoryInterface
{
    /**
     * @return mixed
     */
    public function list(): mixed;

    /**
     * @param $request
     * @return mixed
     */
    public function store($request): mixed;

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id): mixed;

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id): mixed;

    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update($request, $id): mixed;
}
