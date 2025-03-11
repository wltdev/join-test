<?php

namespace Tests\Feature\Produto;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetAllProdutoTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withHeaders([
            'Accept' => 'application/json'
        ]);
    }

    public function test_get_all_produto()
    {
        // create category first
        $responseCreate = $this->postJson('/api/categorias-produtos', [
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

        $response = $this->getJson('/api/produtos');

        $response->assertStatus(200);

        $response->assertJson([
            'success' => true,
            'data' => [
                [
                    'id_produto' => $newProduto['id_produto'],
                    'nome_produto' => 'value'
                ]
            ]
        ]);
    }
}
