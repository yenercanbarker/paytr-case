<?php

namespace App\Http\Interfaces\Admin\ProductVariation;

interface ProductVariationInterface
{
    /**
     * @param $request
     * @return mixed
     */
    public function store($request): mixed;

    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update($request, $id): mixed;

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id): mixed;
}
