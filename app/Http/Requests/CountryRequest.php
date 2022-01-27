<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
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
        $int = (int)$id;

        return [
            'code' => [
                'required',
                'string',
                'min:2',
                'max:2',
                'unique:countries,code,'.$int
            ],
            'name' => [
                'required',
                'string',
                'min:2',
                'max:255',
                'unique:countries,name,'.$int
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
            'code.max' => 'De code van het land moet uit 2 tekens bestaan!',
            'code.min' => 'De code van het land moet uit 2 tekens bestaan!',
            'code.required' => 'Het opgeven van een code voor het land is verplicht!',
            'code.unique' => 'De code voor het land moet uniek zijn. Er is al een land met deze code!', 

            'name.max' => 'De naam van het land mag uit maximaal 255 tekens bestaan!',
            'name.min' => 'De naam van het land moet uit minimaal 2 tekens bestaan!',
            'name.required' => 'Het opgeven van een naam voor het land is verplicht!',
            'name.unique' => 'De naam van het land moet uniek zijn. Er is al een land met deze naam!', 
        ];
    }
}
