<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WedstrijdRequest extends FormRequest
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
            //
            'name.required' => 'de wedstrijdnaam is verplicht',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'duur' => 'integer|min:4',
            'is_active' => 'boolean',
        ];
    }
}
