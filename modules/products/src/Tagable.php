<?php

namespace Lapakilat\ProductModule;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Tagable extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['tag_id'];
    protected $hidden = ['id','tagable_type','tagable_id','created_at', 'updated_at'];

    public function tagable(): MorphTo
    {
        return $this->morphTo();
    }
    public function tag(): BelongsTo
    {
        return $this->belongsTo(\Lapakilat\ProductModule\Tag::class);
    }
}
