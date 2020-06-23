<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBidRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
             'properties.*.id' => ['required', 'string', 'exists:properties'],
             'buyers.*.company' => ['nullable', 'string', 'max:1024'],
             'buyers.*.first_name' => ['required', 'string', 'max:256'],
             'buyers.*.last_name' => ['required', 'string', 'max:256'],
             'buyers.*.address' => ['required', 'string', 'max:1024'],
             'buyers.*.postcode' => ['required', 'string', 'max:16'],
             'buyers.*.telephone' => ['nullable', 'string', 'max:64'],
             'buyers.*.mobile' => ['nullable', 'string', 'max:64'],
             'buyers.*.email' => ['required', 'email', 'max:512'],
             'buyers.*.bidder' => ['boolean'],
             'solicitor.company' => ['nullable', 'string', 'max:1024'],
             'solicitor.first_name' => ['required', 'string', 'max:256'],
             'solicitor.last_name' => ['required', 'string', 'max:256'],
             'solicitor.address' => ['required', 'string', 'max:1024'],
             'solicitor.postcode' => ['required', 'string', 'max:16'],
             'solicitor.telephone' => ['nullable', 'string', 'max:64'],
             'solicitor.mobile' => ['nullable', 'string', 'max:64'],
             'solicitor.email' => ['required', 'email', 'max:512'],
        ];
    }
}
