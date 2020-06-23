<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests\CreateBidRequest;
use App\Person;
use App\Property;

class BiddingController extends Controller
{
    public function create()
    {
        return view('bidding.create', [
            'properties' => Property::all(),
        ]);
    }

    public function store(CreateBidRequest $request)
    {
        $validated = $request->validated();

        $customer = Customer::create();

        $customer->properties()->sync(collect($validated['properties'])->pluck('id'));

        foreach ($validated['buyers'] as $buyer) {
            Person::createBuyer($buyer, $customer);
        }

        Person::createSolicitor($validated['solicitor'], $customer);

        return view('bidding.created');
    }
}
