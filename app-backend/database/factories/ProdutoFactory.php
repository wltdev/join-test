<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produto>
 */
class ProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_categoria_produto' => fake()->numberBetween(1, 10),
            'nome_produto' => 'Produto ' . fake()->numberBetween(1, 10),
            'valor_produto' => fake()->randomFloat(2, 100, 1000)
        ];
    }
}
