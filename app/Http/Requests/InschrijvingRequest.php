<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InschrijvingRequest extends FormRequest
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
     *'required,regex:/^[A-Za-z0-9@!#\$%\^&\*]+$\''
     * @return array
     */
    public function rules()
    {
        return [
            //
            'first_name' => 'required,alpha,min:2',
            'last_name' => 'required,alpha,min:2',
            'email' => [
                'required',
                'email',
            ],

            'streetnumber' => 'integer',
            'street' => 'string',
            'postcode' => 'integer',
            'question' => 'required',
            'ip' => 'ip'
        ];
    }
}

