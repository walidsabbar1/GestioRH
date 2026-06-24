<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('employes', 'email')->ignore($this->route('employe')),
            ],
            'fonction' => 'required|string|max:255',
            'salaire' => 'required|numeric|min:0',
            'date_embauche' => 'required|date',
            'departement_id' => 'required|exists:departements,id',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ];
    }

    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom est obligatoire.',
            'nom.max' => 'Le nom ne doit pas dépasser 255 caractères.',
            'prenom.required' => 'Le prénom est obligatoire.',
            'prenom.max' => 'Le prénom ne doit pas dépasser 255 caractères.',
            'email.required' => "L'adresse email est obligatoire.",
            'email.email' => "L'adresse email n'est pas valide.",
            'email.unique' => 'Cette adresse email est déjà utilisée.',
            'fonction.required' => 'La fonction est obligatoire.',
            'fonction.max' => 'La fonction ne doit pas dépasser 255 caractères.',
            'salaire.required' => 'Le salaire est obligatoire.',
            'salaire.numeric' => 'Le salaire doit être un nombre valide.',
            'salaire.min' => 'Le salaire doit être un nombre positif.',
            'date_embauche.required' => "La date d'embauche est obligatoire.",
            'date_embauche.date' => "La date d'embauche n'est pas valide.",
            'departement_id.required' => 'Veuillez sélectionner un département.',
            'departement_id.exists' => 'Le département sélectionné est invalide.',
            'photo.image' => 'La photo doit être une image valide.',
            'photo.mimes' => 'La photo doit être au format : jpg, jpeg, png ou webp.',
            'photo.max' => 'La taille maximale autorisée est de 5 Mo.',
        ];
    }
}
