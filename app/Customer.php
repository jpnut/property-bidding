<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function buyers()
    {
        return $this->hasMany(Person::class)->buyers();
    }

    public function bidder()
    {
        return $this->hasOne(Person::class)->bidder();
    }

    public function solicitor()
    {
        return $this->hasOne(Person::class)->solicitor();
    }

    public function properties()
    {
        return $this->belongsToMany(Property::class);
    }
}
