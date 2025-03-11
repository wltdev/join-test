<?php

namespace Database\Seeders;

use App\Models\Produto;
use Illuminate\Database\Seeder;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // if table is empty, create 10 records
        if (Produto::count() === 0) {
            Produto::factory(10)->create();
        }
    }
}
