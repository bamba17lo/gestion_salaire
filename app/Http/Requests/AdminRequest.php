<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminRequest extends FormRequest
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
            'email'=>$this->method() === 'POST' ? ['required','email','unique:users,email'] : 
            [Rule::unique('users','email')->ignore($this->users)],
            'name'=> 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Veuillez remplir ce champs',
            'email.email'=> 'Veuillez respecter le format mail. ex: it.global@gmail.com',
            'email.unique'=> 'Cet email existe deja',
            'name.required' => 'Veuillez remplir ce champs',


        ];
    }
}
