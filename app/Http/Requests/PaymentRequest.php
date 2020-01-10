<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstName'         => ['required', 'string', 'min:3'],
            'lastName'          => ['required', 'string', 'min:3'],
            'email'             => ['required', 'email'],
            'address'           => ['required', 'string'],
            'country'           => ['required', 'string'],
            'state'             => ['required', 'string'],
            'zip'               => ['required', 'string'],
            'payment-method'    => ['required'],
            'cc-name'           => ['required', 'string', 'min:3'],
            'cc-number'         => ['required', 'string', 'min:3'],
            'cc-expiration'     => ['required', 'string', 'min:3'],
            'cc-cvv'            => ['required', 'string', 'min:3']
        ];
    }

    public function messages()
    {
        return [
            'firstName'         => 'First name',
            'lastName'          => 'Last name',
            'email'             => 'Email',
            'address'           => 'Address',
            'second-address'    => 'Second Address',
            'country'           => 'Country',
            'state'             => 'State',
            'zip'               => 'Zip code',
            'payment-method'    => 'Payment Method',
            'cc-name'           => 'CC Name',
            'cc-number'         => 'CC Number',
            'cc-expiration'     => 'CC Expiration',
            'cc-cvv'            => 'CC CVV'
        ];
    }
}
