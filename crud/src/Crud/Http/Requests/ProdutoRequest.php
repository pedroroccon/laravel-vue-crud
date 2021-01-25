<?php

namespace Crud\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as FormRequest;
use Illuminate\Validation\Rule;

class ProdutoRequest extends FormRequest
{
    /**
     * Determina se a request está autorizada.
     * Podemos colocar aqui uma determinada 
     * regra de negócio.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Retorna as validações necessárias 
     * para que a request seja enviada.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'codigo' => ['required', Rule::unique('produtos')->ignore(optional(request('produto'))->id)], 
            'titulo' => 'required', 
            'valor' => 'required|numeric|min:0', 
        ];
    }

    /**
     * Define algumas mensagens 
     * amigáveis para os erros 
     * retornados da API.
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'codigo.required' => 'O campo código é obrigatório', 
            'codigo.unique' => 'O código escolhido já está sendo utilizado', 
            'titulo.required' => 'O campo título do produto é obrigatório', 
            'valor.required' => 'O valor do produto é obrigatório', 
            'valor.numeric' => 'O valor deve ser um número'
        ];
    }
}