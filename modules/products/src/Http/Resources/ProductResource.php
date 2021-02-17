<?php

namespace Lapakilat\ProductModule\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

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
            'image' => Storage::disk('products')->url($this->image),
            'images' => $this->imageProducts()->pluck('image')->map(function ($item, $key){
                return Storage::disk('products')->url($item);
            }),
            'price' => $this->price,
            'sale_price' => $this->sale_price,
            'discount' => (boolean) $this->discount,
            'status' => $this->status,
        ];
    }
}
