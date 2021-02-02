<?php

namespace Lapakilat\ProductModule\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'slug',
        'name',
        'image',
        'price',
        'sale_price',
        'discount',
        'status'
    ];

    public function imageProducts()
    {
        return $this->hasMany(ImageProduct::class);
    }
}
