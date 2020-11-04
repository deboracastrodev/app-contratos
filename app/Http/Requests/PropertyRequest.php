<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'street' => 'required|string',
            'neighborhood' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'email_property' => 'required|email|string',
        ];
    }

    public function messages()
    {
        return [
            'complement.string' => 'Este campo deve ser do tipo caracter.',
            'street.required' => 'Este campo é obrigatório.',
            'neighborhood.required' => 'Este campo é obrigatório.',
            'city.required' => 'Este campo é obrigatório.',
            'state.required' => 'Este campo é obrigatório.',
            'email_property.required' => 'Este campo é obrigatório.',
            'email_property.email' => 'Formato de e-mail inválido.',
        ];
    }
}
