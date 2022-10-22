<?php

namespace App\Http\Resources\Admin\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->product->id,
            "product_variation_id" => $this->product_variation_id,
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'discount_percent' => $this->discount_percent,
            'currency_code' => $this->currency_code,
            "category" => [
                "id" => $this->category->id,
                "title" => $this->category->title,
            ],
            "created_at" => $this->updated_at,
            "updated_at" => $this->product->updated_at,
        ];
    }
}