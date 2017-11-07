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
            'first_name' => 'required|string|min:2|max:255',
            'last_name' => 'required|string|min:2|max:255',
            'email' => 'required|email',
            'streetname' => 'string|min:2|max:255',
            'streetnumber' => 'integer|max:255',
            'postcode' => 'integer|max:9999',
            'question.required.integer' => 'de vraag is verplicht',
            'deelnemerIP' => 'ip|unique'
        ];
    }
}

