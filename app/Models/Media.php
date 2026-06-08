<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = "media";
    // protected $fillable = [
    //     'file_name',
    //     'original_name',
    //     'file_path',
    //     'file_type',
    //     'mime_type',
    //     'file_size',
    //     'alt_text',
    //     'uploaded_by',
    // ];
    protected $fillable = [
        'file_name',
        'original_name',
        'file_path',
        'file_type',
        'mime_type',
        'file_size',
        'alt_text',
        'uploaded_by',

        'mediaable_id',
        'mediaable_type',
        'file_url',
        'extension',
        'width',
        'height',
        'sort_order',
        'is_active',
        'updated_at',
    ];

    public $timestamps = false;

    protected $casts = [
        'alt_text' => 'array',
        'created_at' => 'datetime',
    ];

    public function mediaable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
