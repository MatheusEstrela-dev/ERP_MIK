<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'usuario_id',
        'data_pedido',
        'valor_total',
        'status',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
