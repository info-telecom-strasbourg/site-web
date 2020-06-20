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
            'images' => 'json',
            'link_github' => 'url',
            'link_download' => 'url',
            'link_doc' => 'url',
            'chef_projet_id' => 'required|integer',
            'pole_id' => 'required|integer'
        ];
    }
}
