<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Pagos extends Model
{
    protected $fillable =  [

        'user_id', 'descripcion', 'valor'

    ];
}
