<?php

namespace App\Http\Resources\Cart;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            "id" => $this['id'],
            "status" => $this['status'],
            "total_price_without_discount" => $this['total_price_without_discount'],
            "discount_price" => $this['discount_price'],
            "total_price" => $this['total_price'],
            "products" => isset($this['products']) ? $this['products'] : [],
            "created_at" => $this['created_at'],
            "updated_at" => $this['updated_at'],
        ];
    }
}