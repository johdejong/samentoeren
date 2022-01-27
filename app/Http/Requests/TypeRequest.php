<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class TypeRequest extends FormRequest
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
            'type' => [
                'required',
                'string',
                'min:2',
                'max:128',
                'unique:types,type,'.$int
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
            'type.max' => 'Het toertype moet uit maximaal 128 tekens bestaan!',
            'type.min' => 'Het toertype moet uit 2 tekens bestaan!',
            'type.required' => 'Het opgeven van het toertype is verplicht!',
            'type.unique' => 'Het toertype moet uniek zijn. Er is al een toertype met deze naam!', 
        ];
    }
}
