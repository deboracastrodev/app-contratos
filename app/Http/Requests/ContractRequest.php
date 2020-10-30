<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ContractRequest extends FormRequest
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
            'name' => 'required|string',
            'type_person' => 'required|string',
            'property_id' => [
                'required',
                'integer',
                'exists:property,id',
            ],
            'email_contract' => 'required|email|min:3|max:140',
            'document' => $this->type_person && $this->type_person == 'F' ? 'required|string|min:11|max:11' : 'required|string|min:14:max:14',
        ];
    }

    public function messages()
    {
        return [
            'document.min' => 'Este campo deve ter no mínimo :min caracteres.',
            'document.max' => 'Este campo deve ter no máximo :max caracteres.',
            'document.required' => 'Este campo é obrigatório.',
            'name.required' => 'Este campo é obrigatório.',
            'type_person.required' => 'Este campo é obrigatório.',
            'property_id.required' => 'Este campo é obrigatório.',
            'email_contract.required' => 'Este campo é obrigatório.',
            'email_contract.email' => 'Formato inválido.',
            'integer' => 'Este campo deve conter apenas números',
        ];
    }
}
