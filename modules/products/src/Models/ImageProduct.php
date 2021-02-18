<?php

namespace Lapakilat\ProductModule\Models;

use Illuminate\Database\Eloquent\Model;

class ImageProduct extends Model
{
    public $fillable = [
        'image'
    ];
    
    //
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
