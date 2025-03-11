<?php

namespace Tests\Feature\CategoriaProduto;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateCategoriaProdutoTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withHeaders([
            'Accept' => 'application/json'
        ]);
    }

    public function test_update_categoria_produto()
    {
        $responseCreate = $this->postJson('/api/categorias-produtos', [
            'nome_categoria' => 'Eletrodomésticos'
        ]);

        $responseCreate->assertStatus(201);

        $newCategory = $responseCreate->json('data');

        $response = $this->putJson('/api/categorias-produtos/' . $newCategory['id_categoria_planejamento'], [
            'nome_categoria' => 'Eletrodomésticos edited'
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('tb_categoria_produto', [
            'id_categoria_planejamento' => $newCategory['id_categoria_planejamento'],
            'nome_categoria' => 'Eletrodomésticos edited'
        ]);

        $response->assertJson([
            'success' => true,
            'data' => [
                'id_categoria_planejamento' => $newCategory['id_categoria_planejamento'],
                'nome_categoria' => 'Eletrodomésticos edited'
            ]
        ]);
    }
}
