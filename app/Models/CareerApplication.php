<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerApplication extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'career_id',
        'full_name',
        'email',
        'phone',
        'cv_file',
        'message',
    ];

    public function career()
    {
        return $this->belongsTo(Career::class);
    }
}
