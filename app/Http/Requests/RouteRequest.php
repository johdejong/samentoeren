<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class RouteRequest extends FormRequest
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
                'min:2',
                'max:128',
                'unique:routes,name,'.$int,
            ],
            'image' => [
                'required',
                'file',
                'mimetypes:text/xml',
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
            'name.max' => 'De naam van een route moet uit 128 tekens bestaan!',
            'name.min' => 'De naam van een route moet uit 2 tekens bestaan!',
            'name.required' => 'Het opgeven van een naam voor de route is verplicht!',
            'name.unique' => 'De naam van een route moet uniek zijn. Er is al een route met deze naam!',

            'image.file' => 'Het veld onder validatie moet een succesvol geüpload bestand zijn!',
            'image.mimetypes' => 'Het bestand moet van het type text/xml zijn!.',
            'image.required' => 'Er moet verplicht een bestand worden meeegegeven!',
        ];
    }
}
