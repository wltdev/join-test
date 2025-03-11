<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProdutoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_produto' => $this->id_produto,
            'id_categoria_produto' => $this->id_categoria_produto,
            'nome_produto' => $this->nome_produto,
            'valor_produto' => $this->valor_produto,
            'data_cadastro' => $this->data_cadastro,
            'categoria_produto' => $this->categoria_produto
        ];
    }
}
