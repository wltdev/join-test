<?php

namespace Tests\Feature\CategoriaProduto;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteCategoriaProdutoTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withHeaders([
            'Accept' => 'application/json'
        ]);
    }

    public function test_delete_categoria_produto()
    {
        $responseCreate = $this->postJson('/api/categorias', [
            'nome_categoria' => 'Eletrodomésticos'
        ]);

        $responseCreate->assertStatus(201);

        $newCategory = $responseCreate->json('data');

        $response = $this->deleteJson('/api/categorias/' . $newCategory['id_categoria_planejamento']);

        $response->assertStatus(200);

        $this->assertDatabaseMissing('tb_categoria_produto', [
            'id_categoria_planejamento' => $newCategory['id_categoria_planejamento'],
            'nome_categoria' => 'Eletrodomésticos'
        ]);

        $response->assertJson([
            'success' => true,
            'data' => []
        ]);
    }
}
