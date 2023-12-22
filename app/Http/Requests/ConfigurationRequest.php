<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfigurationRequest extends FormRequest
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
            'type'=>'required|unique:configurations,type',
            'value'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'type.required'=>'Le champs ne doit pas etre vide',
            'type.unique'=>'Ce type existe deja',
            'value.required'=>'Le champs ne doit pas etre vide',
        ];
    }
}
