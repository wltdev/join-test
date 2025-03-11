<?php

namespace Tests\Feature\CategoriaProduto;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetOneCategoriaProdutoTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withHeaders([
            'Accept' => 'application/json'
        ]);
    }

    public function test_get_one_categoria_produto()
    {
        $responseCreate = $this->postJson('/api/categorias', [
            'nome_categoria' => 'Eletrodomésticos'
        ]);

        $responseCreate->assertStatus(201);

        $newCategory = $responseCreate->json('data');

        $response = $this->getJson('/api/categorias/' . $newCategory['id_categoria_planejamento']);

        $response->assertStatus(200);

        $response->assertJson([
            'success' => true,
            'data' => [
                'id_categoria_planejamento' => $newCategory['id_categoria_planejamento'],
                'nome_categoria' => 'Eletrodomésticos'
            ]
        ]);
    }

    public function test_get_one_categoria_produto_with_invalid_id()
    {
        $response = $this->getJson('/api/categorias/1');

        $response->assertStatus(404);
        $response->assertJson([
            'error' => 'Record not found'
        ]);
    }
}
