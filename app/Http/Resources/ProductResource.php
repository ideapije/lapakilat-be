<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->name,
            'image' => $this->image,
            'images' => $this->imageProducts()->pluck('image')->toArray(),
            'price' => $this->price,
            'sale_price' => $this->sale_price,
            'discount' => (boolean) $this->discount,
            'status' => $this->status,
        ];
    }
}
