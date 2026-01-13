<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AffiliateStore extends Model
{
    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'url',
        'commission_rate',
        'logo_url',
        'logo_favicon_url',
        'description',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'affiliate_type', 'name');
    }
}
