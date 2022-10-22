<?php

namespace App\Http\Resources\Admin\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductListShowcaseResource extends JsonResource
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
            "is_favorite" => isset($this->is_favorited) ? $this->is_favorited : false,
            "id" => $this['product']['product_id'],
            "product_variation_id" => $this['product']['product_variation_id'],
            'title' => $this['product']['title'],
            'description' => $this['product']['description'],
            'price' => $this['product']['price'],
            'discount_percent' => $this['product']['discount_percent'],
            'currency_code' => $this['product']['currency_code'],
            "category" => [
                "id" => isset($this['product']['category']['id']) ? $this['product']['category']['id'] : null,
                "title" => isset($this['product']['category']['title']) ? $this['product']['category']['title'] : null,
            ],
            "created_at" => $this['product']['created_at'],
            "updated_at" => $this['product']['updated_at'],
        ];
    }
}
