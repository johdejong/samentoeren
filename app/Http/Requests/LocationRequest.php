<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class LocationRequest extends FormRequest
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
        $id = \Route::current()->parameter('id');
        $int = (int) $id;

        return [
            'name' => [
                'required',
                'string',
                'min:5',
                'max:255',
                'unique:locations,name,'.$int,
            ],
            'residence' => [
                'required',
                'string',
                'min:2',
                'max:255',
            ],
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
            'name.max' => 'De naam van de locatie mag uit maximaal 255 tekens bestaan!',
            'name.min' => 'De naam van de locatie moet uit minimaal 5 tekens bestaan!',
            'name.required' => 'Het opgeven van een naam voor de locatie is verplicht!',
            'name.unique' => 'De naam van een locatie moet uniek zijn. Er is al een locatie met deze naam!',

            'residence.max' => 'De plaats van de locatie mag uit maximaal 255 tekens bestaan!',
            'residence.min' => 'De plaats van de locatie moet uit minimaal 2 tekens bestaan!',
            'residence.required' => 'Het opgeven van een plaats voor de locatie is verplicht!',
        ];
    }
}
