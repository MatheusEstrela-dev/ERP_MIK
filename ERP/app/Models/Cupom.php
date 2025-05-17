<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cupom extends Model
{
    protected $fillable = [
        'codigo',
        'tipo',
        'valor',
        'data_validade',
        'ativo',
    ];
}
