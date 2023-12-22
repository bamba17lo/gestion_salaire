<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeRequest extends FormRequest
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
            'nom'=>'required|min:2|string',
            'prenom'=>'required|min:3|string',
            // method 1 pour ajouter si la methode est POST sinon il va update
            'email'=> $this->method() ==='POST' ? 'required|email|unique:employes,email'
                : 'required|email|unique:employes,email,'.$this->employe->id,

            // method 2 pour ajouter si la methode est POST sinon il va update
            'telephone'=> $this->method() === 'POST' ? ['required','numeric','unique:employes,telephone']
                : [Rule::unique('employes','telephone')->ignore($this->employe)] ,

            'departements_id'=>'required|exists:departements,id|integer',
            'montant_journalier'=>'required|numeric|min:2500',

        ];
    }
        public function messages()
        {
            return [
                'nom.required'=>'Veuillez remplir ce champs',
                'nom.string'=>'Ce champs doit contenir que des chaine de caractere',
                'nom.min'=>'Ce champs doit comporter au minimum 2 caracetere',
                'prenom.min'=>'Ce champs doit comporter au minimum 3 caracetere',
                'prenom.string'=>'Ce champs doit contenir que des chaine de caractere',
                'prenom.required'=>'Veuillez remplir ce champs',
                'email.required'=>'Veuillez remplir ce champs',
                'email.unique'=>'Cet email existe deja',
                'email.email'=>'Veuillez respecter le format mail. ex: it.global@gmail.com ',
                'telephone.required'=>'Veuillez remplir ce champs',
                'telephone.unique'=>'Ce numero de telephone existe deja',
                'departements_id.required'=>'Veuillez remplir ce champs',
                'departements_id.exists'=> 'l\'id que vous avez choisi n\'existe pas ',
                'telephone.numeric'=> 'Ce champs doit contenir que des nombres ',
                'montant_journalier.numeric'=> 'Ce champs doit contenir que des nombres ',
                'montant_journalier.required'=> 'Veuillez remplir ce champs',
                'montant_journalier.min'=> 'Le montant d\'un journalier doit etre superieur a 2500',

            ];
        }
}

