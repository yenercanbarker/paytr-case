<?php

namespace App\Http\Resources\Admin\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCartResource extends JsonResource
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
            "id" => $this->products[0]->product_id,
            "product_variation_id" => $this->product_variation_id,
            'title' => $this->products[0]->title,
            'description' => $this->products[0]->description,
            'price' => $this->products[0]->price,
            'discount_percent' => $this->products[0]->discount_percent,
            'total_price_without_discount' => $this->total_price_without_discount,
            'discount_price' => $this->discount_price,
            'total_price' => $this->total_price,
            'currency_code' => $this->products[0]->currency_code,
            "category" => [
                "id" => $this->products[0]->category->id,
                "title" => $this->products[0]->category->title,
            ],
            "created_at" => $this->products[0]->created_at,
            "updated_at" => $this->products[0]->updated_at,
        ];
    }
}