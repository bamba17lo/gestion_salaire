<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmitAccountAdmin extends FormRequest
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
            'code'=>'required|exists:reset_code_notifications,code',
            'password'=> 'required|confirmed',
            'password_confirmation'=> 'required',
        ];
    }

    public function messages()
    {
       return [

         'password.required' => 'Veuillez remplir ce champs',
         'code.required' => 'Veuillez remplir ce champs',
         'code.exists' => 'Ce code est invalide, veuillez regarder votre boite mail',
         'password_confirmation.required' => 'Veuillez remplir ce champs',
         'password.confirmed' => 'les mots de passe ne sont pas identiques',
       ];
    }
}
