<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Endereco extends Model
{
    protected $table = 'enderecos'; 

     protected $fillable = [
        'rua',
        'numero',
        'complemento',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
