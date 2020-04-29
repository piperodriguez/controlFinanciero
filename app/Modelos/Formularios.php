<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Formularios extends Model
{
  public $timestamps = false;
  protected $guarded = [];
  protected $fillable = [];
  protected $table = 'n_formulario';
  protected $primaryKey = 'id';
}
