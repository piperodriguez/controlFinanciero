<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNFormularioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('n_formulario', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom_tabla');
            $table->boolean('primary_key');
            $table->string('nom_programa');
            $table->string('tipo_campo');
            $table->string('nom_campo');
            $table->integer('long_max')->nullable();
            $table->string('label')->nullable();
            $table->text('query_campo')->nullable();
            $table->text('listado')->nullable();
            $table->text('select')->nullable();
            $table->integer('ordenamiento')->nullable();
            $table->double('max_val')->nullable();
            $table->double('min_val')->nullable();
            $table->boolean('requerido')->nullable();
            $table->integer('valor')->nullable();
            $table->string('group_by')->nullable();
            $table->string('order_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('n_formulario');
    }
}
