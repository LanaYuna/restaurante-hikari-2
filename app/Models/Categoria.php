<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{
    protected $table = 'categorias'; 

    protected $fillable = ['descricao'];

    public function produtos(): HasMany // 1:N
    {
        return $this->hasMany(Produto::class, 'categoria_id');
    }
}
