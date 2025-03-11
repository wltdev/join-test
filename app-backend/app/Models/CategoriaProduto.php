<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaProduto extends Model
{
    use HasFactory;

    protected $table = 'tb_categoria_produto';
    public $timestamps = false;

    protected $fillable = [
        'nome_categoria'
    ];

    protected $primaryKey = 'id_categoria_planejamento';

    public function produtos()
    {
        return $this->hasMany(Produto::class, 'id_categoria_produto', 'id_categoria_planejamento');
    }
}
