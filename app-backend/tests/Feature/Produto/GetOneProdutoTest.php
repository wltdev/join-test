<?php

namespace Tests\Feature\Produto;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetOneProdutoTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withHeaders([
            'Accept' => 'application/json'
        ]);
    }

    public function test_get_one_produto()
    {
        // create category first
        $responseCreate = $this->postJson('/api/categorias', [
            'nome_categoria' => 'Eletrodomésticos'
        ]);

        $responseCreate->assertStatus(201);

        $newCategory = $responseCreate->json('data');

        // create produto
        $responseCreate = $this->postJson('/api/produtos', [
            'id_categoria_produto' => $newCategory['id_categoria_planejamento'],
            'nome_produto' => 'value',
            'valor_produto' => 10.00
        ]);

        $responseCreate->assertStatus(201);

        $newProduto = $responseCreate->json('data');

        $response = $this->getJson('/api/produtos/' . $newProduto['id_produto']);

        $response->assertStatus(200);

        $response->assertJson([
            'success' => true,
            'data' => [
                'id_produto' => $newProduto['id_produto'],
                'nome_produto' => 'value'
            ]
        ]);
    }

    public function test_get_one_produto_with_invalid_id()
    {
        $response = $this->getJson('/api/produtos/1');

        $response->assertStatus(404);
        $response->assertJson([
            'error' => 'Record not found'
        ]);
    }
}
