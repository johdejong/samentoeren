<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class ResidenceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'residence' => [
                'required',
                'string',
                'min:2',
                'max:255',
            ] 
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'residence.max' => 'De plaats mag uit maximaal 255 tekens bestaan!',
            'residence.min' => 'De plaats moet uit minimaal 2 tekens bestaan!',
            'residence.required' => 'Het opgeven van een plaats is verplicht!',
        ];
    }
}
