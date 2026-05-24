<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use SoftDeletes;

    protected $table = "sections";

    protected $fillable = [
        'page_id',
        'type',
        'title',
        'description',
        'settings',
        'sort_order',
        'section_code',
        'is_active',
        'media_id',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'title' => 'array',
        'description' => 'array',
        'settings' => 'array',
        'is_active' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function media()
    {
        return $this->belongsTo(Media::class, 'media_id');
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'section_id', 'id');
    }
}
