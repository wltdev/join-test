<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'tb_produto';
    public $timestamps = false;

    protected $fillable = [
        'id_categoria_produto',
        'nome_produto',
        'valor_produto',
        'data_cadastro'
    ];

    protected $primaryKey = 'id_produto';


    public function categoria_produto()
    {
        return $this->belongsTo(CategoriaProduto::class, 'id_categoria_produto', 'id_categoria_planejamento');
    }
}
