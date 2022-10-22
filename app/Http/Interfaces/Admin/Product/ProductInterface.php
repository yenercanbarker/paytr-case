<?php

namespace App\Http\Interfaces\Admin\Product;

interface ProductInterface
{
    /**
     * @return mixed
     */
    public function list(): mixed;

    /**
     * @return mixed
     */
    public function store(): mixed;

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id): mixed;

    /**
     * @param $id
     * @return mixed
     */
    public function editWithoutFail($id): mixed;

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id): mixed;

    /**
     * @param $id
     * @return mixed
     */
    public function deleteWithoutCheck($id): mixed;

    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update($request, $id): mixed;
}
