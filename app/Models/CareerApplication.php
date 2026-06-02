<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerApplication extends Model
{
    public $timestamps = false;

    protected $table = "career_applications";

    protected $fillable = [
        'career_id',
        'full_name',
        'email',
        'phone',
        'cv_file',
        'message',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];


    public function career()
    {
        return $this->belongsTo(Career::class);
    }
}
