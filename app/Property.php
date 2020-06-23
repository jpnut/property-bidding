<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'address', 'location', 'region', 'postcode', 'advert_id', 'name', 'category', 'asking_price', 'leasehold_price'
    ];

    protected $casts = [
        'asking_price'    => 'integer',
        'leasehold_price' => 'integer',
    ];

    public function customers()
    {
        return $this->belongsToMany(Customer::class);
    }
}
