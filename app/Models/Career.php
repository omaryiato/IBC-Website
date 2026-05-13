<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Career extends Model
{
    use SoftDeletes;

    protected $table = "careers";

    protected $fillable = [
        'title',
        'description',
        'requirements',
        'location',
        'employment_type',
        'deadline',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'title' => 'array',
        'description' => 'array',
        'requirements' => 'array',
        'is_active' => 'integer',
        'deadline' => 'date',
    ];

    public function applications()
    {
        return $this->hasMany(CareerApplication::class);
    }
}
