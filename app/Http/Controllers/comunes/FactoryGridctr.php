<?php

namespace App\Http\Controllers\comunes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;

class FactoryGridctr extends Controller
{

	
    public function newGrid($nombre){

    	$msg = "hola como vas escuchando pimpinela ... que te hace falta hoy";
    	$msg .= "vaya y viene el siguiente parametro ->".$nombre;
    	return $msg;
    }
}
