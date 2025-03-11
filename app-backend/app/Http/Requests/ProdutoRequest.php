<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProdutoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function attributes()
    {
        return [
            'id_categoria_produto' => 'ID da categoria',
            'nome_produto' => 'Nome do produto',
            'valor_produto' => 'Valor do produto'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id_categoria_produto' => 'required|exists:tb_categoria_produto,id_categoria_planejamento',
            'nome_produto' => 'required|string|max:150',
            'valor_produto' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O :attribute é obrigatório',
            'string' => 'O :attribute deve ser uma string',
            'max' => 'O :attribute deve ter no máximo 150 caracteres',
            'numeric' => 'O :attribute deve ser um número',
            'exists' => 'O :attribute não existe'
        ];
    }

    protected function withValidator(Validator $validator)
    {
        if ($validator->fails()) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422));
        }
    }
}
