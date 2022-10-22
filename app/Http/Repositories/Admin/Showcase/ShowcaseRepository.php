<?php

namespace App\Http\Repositories\Admin\Showcase;

use App\Http\Interfaces\Admin\Showcase\ShowcaseInterface;
use App\Models\Showcase;

class ShowcaseRepository implements ShowcaseInterface
{
    /**
     * Showcase Instance
     * @var Showcase
     */
    private $showcase;

    /**
     * Showcase Repository Constructor
     * @param Showcase $_showcase
     */
    public function __construct(Showcase $_showcase)
    {
        $this->showcase = $_showcase;
    }

    /**
     * Showcase Repository Store
     * @param $request
     * @return mixed
     */
    public function store($request): mixed
    {
        return $this->showcase
            ->create($request);
    }

    /**
     * Showcase Repository Edit
     * @param $id
     * @return mixed
     */
    public function edit($id): mixed
    {
        return $this->showcase
            ->where('id', $id)
            ->firstOrFail();
    }
}