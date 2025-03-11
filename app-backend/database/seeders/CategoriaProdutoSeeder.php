<?php

namespace Database\Seeders;

use App\Models\CategoriaProduto;
use Illuminate\Database\Seeder;

class CategoriaProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // if table is empty, create 10 records
        if (CategoriaProduto::count() === 0) {
            CategoriaProduto::factory(10)->create();
        }
    }
}
