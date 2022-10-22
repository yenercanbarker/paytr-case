<?php

namespace App\Http\Interfaces\Admin\ProductShowcase;

interface ProductShowcaseInterface
{
    /**
     * @param $request
     * @return mixed
     */
    public function store($request): mixed;

    /**
     * @param $showcaseId
     * @return mixed
     */
    public function list($showcaseId): mixed;
}
