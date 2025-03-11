<?php

namespace Tests\Feature\Produto;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateProdutoTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withHeaders([
            'Accept' => 'application/json'
        ]);
    }

    public function test_create_produto()
    {
        // create category first
        $responseCreate = $this->postJson('/api/categorias', [
            'nome_categoria' => 'Eletrodomésticos'
        ]);

        $responseCreate->assertStatus(201);

        $newCategory = $responseCreate->json('data');

        $response = $this->postJson('/api/produtos', [
            'id_categoria_produto' => $newCategory['id_categoria_planejamento'],
            'nome_produto' => 'value',
            'valor_produto' => 10.00
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('tb_produto', [
            'nome_produto' => 'value'
        ]);

        $response->assertJson([
            'success' => true,
            'data' => [
                'nome_produto' => 'value'
            ]
        ]);
    }

    public function test_create_produto_with_invalid_data()
    {
        $response = $this->postJson('/api/produtos', [
            'nome_produto_invalid' => 'value'
        ]);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(['nome_produto']);
    }
}
