<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLancamentoRequest extends FormRequest
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
            'itens'             => 'array|required',
            'itens.*.id'        => 'numeric|required',
            'itens.*.quantity'  => 'numeric|required',
            'type'              => 'required',
            'user_id'           => 'required',
        ];
    }
}
