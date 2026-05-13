<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;

    protected $table = "blogs";

    protected $fillable = [
        'slug',
        'title',
        'excerpt',
        'content',
        'featured_media_id',
        'seo',
        'is_published',
        'published_at',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'title' => 'array',
        'excerpt' => 'array',
        'content' => 'array',
        'seo' => 'array',
        'is_published' => 'integer',
        'published_at' => 'datetime',
    ];

    public function media()
    {
        return $this->belongsTo(Media::class, 'featured_media_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
