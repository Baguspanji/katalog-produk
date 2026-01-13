<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'message',
        'rating',
        'is_approved',
    ];
}
