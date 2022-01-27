<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class DistancecategoryRequest extends FormRequest
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
            'distancecategory' => [
                'required',
                'string',
                'min:2',
                'max:64',
                'unique:distancecategories,distancecategory,'.$int
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
            'distancecategory.max' => 'De naam van de afstandscategorie moet uit minimaal 64 tekens bestaan!',
            'distancecategory.min' => 'De naam van de afstandscategorie moet uit maximaal 2 tekens bestaan!',
            'distancecategory.required' => 'Het opgeven van een naam voor de afstandscategorie is verplicht!',
            'distancecategory.unique' => 'De naam van de afstandscategorie moet uniek zijn!', 
        ];
    }
}
