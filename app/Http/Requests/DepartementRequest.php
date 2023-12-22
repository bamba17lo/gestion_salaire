<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartementRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required|unique:departements,name'
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Le champs nom du departement ne doit pas etre vide',
            'name.unique'=>'Le  nom du departement existe deja',
        ];
    }
}
