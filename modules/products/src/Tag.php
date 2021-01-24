<?php

namespace Lapakilat\ProductModule;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'image', 'as_category'];
    protected $hidden = ['created_at', 'updated_at'];

    public function items()
    {
        return $this->hasMany(\Lapakilat\ProductModule\Tagable::class);
    }
}
