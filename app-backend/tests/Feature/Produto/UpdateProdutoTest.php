<?php

namespace Tests\Feature\Produto;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateProdutoTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withHeaders([
            'Accept' => 'application/json'
        ]);
    }

    public function test_update_produto()
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

        $response = $this->putJson('/api/produtos/' . $newProduto['id_produto'], [
            'nome_produto' => 'value edited',
            'valor_produto' => 12.00,
            'id_categoria_produto' => $newCategory['id_categoria_planejamento']
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('tb_produto', [
            'id_produto' => $newProduto['id_produto'],
            'nome_produto' => 'value edited'
        ]);

        $response->assertJson([
            'success' => true,
            'data' => [
                'id_produto' => $newProduto['id_produto'],
                'nome_produto' => 'value edited'
            ]
        ]);
    }
}
