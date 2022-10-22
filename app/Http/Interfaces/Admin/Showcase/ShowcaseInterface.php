<?php

namespace App\Http\Interfaces\Admin\Showcase;

interface ShowcaseInterface
{
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
}
