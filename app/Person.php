<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable = [
        'company', 'first_name', 'last_name', 'address', 'postcode', 'telephone', 'mobile', 'email', 'buyer', 'bidder',
        'solicitor'
    ];

    public static function createBuyer(array $input, Customer $customer)
    {
        $buyer = new self(array_merge($input, ['buyer' => true]));

        $buyer->customer()->associate($customer);

        $buyer->save();

        return $buyer;
    }

    public static function createSolicitor(array $input, Customer $customer)
    {
        $solicitor = new self(array_merge($input, ['solicitor' => true]));

        $solicitor->customer()->associate($customer);

        $solicitor->save();

        return $solicitor;
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function scopeBuyers(Builder $query): Builder
    {
        return $query->where('buyer', true);
    }

    public function scopeBidder(Builder $query): Builder
    {
        return $query->where('bidder', true);
    }

    public function scopeSolicitor(Builder $query): Builder
    {
        return $query->where('solicitor', true);
    }
}
