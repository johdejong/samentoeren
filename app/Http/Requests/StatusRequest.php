<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class StatusRequest extends FormRequest
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
            'status' => [
                'required',
                'string', 
                'min:2',
                'max:128',
                'unique:statuses,status,'.$int
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
            'status.max' => 'De toerstatus moet uit maximaal 128 tekens bestaan!',
            'status.min' => 'De toerstatus moet uit 2 tekens bestaan!',
            'status.required' => 'Het opgeven van een toerstatus is verplicht!',
            'status.unique' => 'De toerstatus moet uniek zijn. Er is al een toerstatus met deze naam!', 
        ];
    }
}
