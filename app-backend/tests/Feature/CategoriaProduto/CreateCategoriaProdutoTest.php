<?php

namespace Tests\Feature\CategoriaProduto;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateCategoriaProdutoTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withHeaders([
            'Accept' => 'application/json'
        ]);
    }

    public function test_create_categoria_produto()
    {
        $response = $this->postJson('/api/categorias-produtos', [
            'nome_categoria' => 'Eletrodomésticos'
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('tb_categoria_produto', [
            'nome_categoria' => 'Eletrodomésticos'
        ]);

        $response->assertJson([
            'success' => true,
            'data' => [
                'nome_categoria' => 'Eletrodomésticos'
            ]
        ]);
    }

    public function test_create_categoria_produto_with_invalid_data()
    {
        $response = $this->postJson('/api/categorias-produtos', [
            'nome_categoria_invalid' => 'value'
        ]);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(['nome_categoria']);
    }
}
