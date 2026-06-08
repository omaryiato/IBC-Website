<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;

    protected $table = "items";

    protected $fillable = [
        'section_id',
        'type',
        'title',
        'description',
        // 'media_id',
        'link',
        'extra_data',
        'sort_order',
        'item_code',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'title' => 'array',
        'description' => 'array',
        'extra_data' => 'array',
        'is_active' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }

    // public function media()
    // {
    //     return $this->belongsTo(Media::class, 'media_id', 'id');
    // }

    public function media()
    {
        return $this->morphOne(Media::class, 'mediaable');
    }
    // public function media()
    // {
    //     return $this->morphMany(Media::class, 'mediaable');
    // }

}
