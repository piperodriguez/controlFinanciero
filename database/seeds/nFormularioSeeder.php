<?php
use App\Modelos\Formularios;
use Illuminate\Database\Seeder;

class nFormularioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Formularios::create([
            'nom_tabla' => 'pagos',
            'primary_key' => true,
            'nom_programa' => 'formularioPagos',
            'tipo_campo' => 'hidden',
            'nom_campo' => 'id'
        ]);
        Formularios::create([
            'nom_tabla' => 'pagos',
            'primary_key' => false,
            'nom_programa' => 'formularioPagos',
            'tipo_campo' => 'text',
            'nom_campo' => 'descripcion',
            'label' => 'Descripcion',
            'requerido' => 1
        ]);
         Formularios::create([
            'nom_tabla' => 'pagos',
            'primary_key' => false,
            'nom_programa' => 'formularioPrueba',
            'tipo_campo' => 'moneda',
            'nom_campo' => 'valor',
            'label' => 'valor',
            'requerido' => 1
        ]);
        /*
        Formularios::create([
            'nom_tabla' => 'pagos',
            'primary_key' => false,
            'nom_programa' => 'formularioPrueba',
            'tipo_campo' => 'date',
            'nom_campo' => 'fecha_pago',
            'label' => 'fecha cancelaci�n deuda',
            'requerido' => 1
        ]);
        Formularios::create([
            'nom_tabla' => 'pagos',
            'primary_key' => false,
            'nom_programa' => 'formularioPrueba',
            'tipo_campo' => 'celular',
            'nom_campo' => 'nom_celular',
            'label' => '# celular',
            'max_val' => 10,
            'min_val' => 10,
            'requerido' => 1
        ]);
        Formularios::create([
            'nom_tabla' => 'pagos',
            'primary_key' => false,
            'nom_programa' => 'formularioPrueba',
            'tipo_campo' => 'textarea',
            'nom_campo' => 'descripcion_cancelacion',
            'label' => 'causal de pago',
            'min_val' => 5,
            'requerido' => 1
        ]);
        Formularios::create([
            'nom_tabla' => 'pagos',
            'primary_key' => false,
            'nom_programa' => 'formularioPrueba',
            'tipo_campo' => 'hidden',
            'nom_campo' => 'oculto',
            'requerido' => 0
        ]);

        Formularios::create([
            'nom_tabla' => 'pagos',
            'primary_key' => false,
            'nom_programa' => 'formularioPrueba',
            'tipo_campo' => 'hidden',
            'nom_campo' => 'oculto',
            'requerido' => 0
        ]);
        Formularios::create([
            'nom_tabla' => 'pagos',
            'primary_key' => false,
            'nom_programa' => 'formularioPrueba',
            'tipo_campo' => 'select',
            'nom_campo' => 'id_compromiso',
            'label' => 'Nit de la oblgiacion',
            'requerido' => 1,
            'query_campo' => 'select id as id , nit as text from  compromisos'
        ]);
        Formularios::create([
            'nom_tabla' => 'pagos',
            'primary_key' => false,
            'nom_programa' => 'formularioPrueba',
            'tipo_campo' => 'int',
            'nom_campo' => 'cod_postal',
            'label' => 'codigo postal',
            'requerido' => 1,
        ]);*/
    }
}
