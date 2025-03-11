<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_produto', function (Blueprint $table) {
            $table->id('id_produto');

            $table->foreignId('id_categoria_produto')
                ->constrained('tb_categoria_produto', 'FK_tb_produto_tb_categoria_produto')
                ->references('id_categoria_planejamento')
                ->cascadeOnDelete();

            $table->string('nome_produto', 150);
            $table->float('valor_produto', 10, 2);
            $table->dateTime('data_cadastro')->default(now());
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_produto');
    }
};
