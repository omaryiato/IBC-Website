<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;

    protected $table = "pages";

    protected $fillable = [
        'slug',
        'meta_title',
        'meta_description',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'meta_title' => 'array',
        'meta_description' => 'array',
        'is_active' => 'integer',
    ];

    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}
