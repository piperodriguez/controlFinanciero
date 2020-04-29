<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngresosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ingresos')->insert([
            'descripcion' => 'Nomina',
            'valor' => 920000
        ]);
    }
}
