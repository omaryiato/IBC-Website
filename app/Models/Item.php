<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'section_id',
        'title',
        'description',
        'media_id',
        'link',
        'extra_data',
        'sort_order',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'title' => 'array',
        'description' => 'array',
        'extra_data' => 'array',
        'is_active' => 'integer',
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function media()
    {
        return $this->belongsTo(Media::class);
    }
}
