<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use App\Modelos\Pagos;

class Pagos extends Model
{
    protected $fillable =  [

        'id','descripcion', 'valor'

    ];
}
