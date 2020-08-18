<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * TODO
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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'desc' => 'required',
            'link_github' => 'nullable|url',
            'link_download' => 'nullable|url',
            'link_doc' => 'nullable|url',
            'complete' => 'boolean',
            'chef_projet_id' => 'required|integer',
            'pole_id' => 'required|integer',
            'collaborateur_id' => 'nullable',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'Un tire est nécéssaire',
            'desc.required'  => 'Une description est nécéssaire',
            'link_github.required'  => 'Un lien GitHub est nécéssaire',
            'link_doc.required'  => 'Un lien vers la documentation est nécéssaire',
            'complete.required'  => 'Indquez si le projet est finis ou pas',
            'chef_projet_id.required'  => 'Indiquez le chef de projet',
            'pole_id.required'  => 'Indiquez le pôle auquel appartient le projet',
        ];
    }
}
