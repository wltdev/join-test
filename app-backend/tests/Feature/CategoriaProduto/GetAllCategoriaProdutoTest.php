<?php

namespace Tests\Feature\CategoriaProduto;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetAllCategoriaProdutoTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withHeaders([
            'Accept' => 'application/json'
        ]);
    }

    public function test_get_all_categoria_produto()
    {
        $responseCreate = $this->postJson('/api/categorias-produtos', [
            'nome_categoria' => 'Eletrodomésticos'
        ]);

        $responseCreate->assertStatus(201);

        $newCategory = $responseCreate->json('data');

        $response = $this->getJson('/api/categorias-produtos');

        $response->assertStatus(200);

        $response->assertJson([
            'success' => true,
            'data' => [
                [
                    'id_categoria_planejamento' => $newCategory['id_categoria_planejamento'],
                    'nome_categoria' => 'Eletrodomésticos'
                ]
            ]
        ]);
    }
}
