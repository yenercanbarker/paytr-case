<?php

namespace App\Http\Resources\Admin\Product;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "product_variation_id" => $this->variations->product_variation_id,
            'title' => $this->variations->title,
            'description' => $this->variations->description,
            'price' => $this->variations->price,
            'discount_percent' => $this->variations->discount_percent,
            'currency_code' => $this->variations->currency_code,
            "category" => [
                "id" => $this->variations->category->id,
                "title" => $this->variations->category->title,
            ],
            "created_at" => $this->created_at,
            "updated_at" => $this->variations->updated_at,
        ];
    }
}