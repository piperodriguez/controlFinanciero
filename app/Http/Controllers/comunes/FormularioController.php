<?php

namespace App\Http\Controllers\comunes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Modelos\Formularios;

/**
 * Clase FormularioController
 * @category Controller
 * @author Juan Felipe Rodr�guez Vargas <vargasjuan367@gmail.com>
 * @version  FormularioController.php  2020-04-28
 * @copyright 2020 proyecto inovador
 *
 */

class FormularioController extends Controller
{
   /**
    * $_model
    * @var string Nombre del modelo
    */
    private $_model;

    /**
     * Funci�n constructor
     */
    function __construct()
    {
        $this->middleware('auth');
        $this->_model = new formularios();
    }

    /**
     * Metodo CrearFormulario
     * renderiza la vista que contiene
     * la estructura del formulario d�namico.
     * recibiendo como parametro el nom programa
     * @param $nomprograma.
     * el cual asocia los campos que se deben crear
     * @return html del formulario
     */

     public function crearFormulario($nomprograma)
     {

        $formulario =  $this->_model->where('nom_programa', $nomprograma)->get();
        $idFormulario = $formulario[0]["nom_programa"];

        $id = null;
        $dataUpdate = null;

        $htmlForm = null;
        $htmlForm .= view('formulario.etiquetaFormulario')
        ->with('id_formulario', $idFormulario)
        ->with('id', $id)
        ->renderSections()['apertura'];

        foreach ($formulario as $key => $record) {
            $vista = "formulario.{$record['tipo_campo']}";
            $htmlForm .= view(
                $vista, [
                'data' => $record,
                'dataUpdate' => $dataUpdate
                ]
            )->render();
        }

        $htmlForm .= view('formulario.etiquetaFormulario')
        ->with('id_formulario', $idFormulario)
        ->with('id', $id)
        ->renderSections()['cierre'];

        if (isset($_REQUEST['_token'])) {
          $strform = $htmlForm;
          return view('formulario.form', compact('strform'));
        } else {
          return $htmlForm;
        }

     }

    /**
     * Metodo getSelect
     * Se encarga de crear el select
     * la peticion viene por medio de ajax
     * del formulario segun los registros
     * que vienen en el nomprograma
     * @param $request
     * @return boolean
     */
     public function getSelect(Request $request)
     {
        if (!empty($request->id)) {
          $query = DB::select($request->querySelectOne);
          $query2 = DB::select($request->querySelect);
          $query = array('resultIndividual' => $query, 'result' => $query2);
          return $query;
        } else {
          $query = DB::select($request->querySelect);
          $query = array('result' => $query);
          return $query;
        }
     }

    /**
     * Metodo save
     * Se encarga de recibir los datos enviados
     * por el formulario y guardarlos
     * @param $request
     * @return boolean
     */
     public function save(Request $request)
     {
        $tabla = "";
        $arrvalidacion = [];
        $query = $this->_model->where('nom_programa', $request->nom_programa)->get();

        foreach ($query as $nformulario) {

          $campo = $nformulario->nom_campo;
          $arrvalidacion[$campo] = "";

          if ($nformulario->primary_key === true) {
            $tabla = $nformulario->nom_tabla;
          }

          if ($nformulario->requerido === true) {
            $arrvalidacion[$campo] .= "required|";
          }

          if (!empty($nformulario->min_val) && $nformulario->min_val > 0) {
            $arrvalidacion[$campo] .= "min:{$nformulario->min_val}|";
          }

          if (!empty($nformulario->max_val) && $nformulario->max_val > 0) {
            $arrvalidacion[$campo] .= "max:{$nformulario->max_val}";
          }

          if (!empty($nformulario->tipo_campo == 'email')) {
            $arrvalidacion[$campo] .= "email|unique:$tabla";
          }

          if (!empty($nformulario->tipo_campo == 'moneda')) {
            $request->$campo = str_replace(',', '', $request->$campo);
            $request->merge([$campo => $request->$campo]);
          }
        }

        $datosValidados = request()->validate($arrvalidacion);

        foreach ($query as $nformulario) {
          $campo = $nformulario->nom_campo;
          $value = $request->get($campo);
          if (Schema::hasColumn($tabla, $campo) && isset($value)) {
            $arrguardado[$campo] = $request->get($campo);
          }
        }

        $this->_model->setTable($tabla);
        $result = $this->_model->create($arrguardado);

        return response()->json(
            [
              [
                'estadoRespuesta' => 'Nuevo',
                'respuesta' => $datosValidados,
              ]
            ]
        );
     }

    /**
     * Metodo edit
     * Se encarga de cargar los datos
     * del registro seleccionado en datatable
     * y pintarlos en los inputs
     * del formulario que cree
     * @param $request
     * @return boolean
     */
     public function edit(Request $request)
     {
       $name = $request->get('modelo');
       $modelo = session('tablas')[$name]['model'];
       $id = $request->get('id');
       $pk = $modelo->getKeyName();
       $nameTable = $modelo->getTable();

       $queryData = $modelo->where($pk, $id)->get();

       $formulario = $this->_model->where('nom_tabla', $nameTable)->get();

       $idFormulario = $formulario[0]["nom_programa"];

        $htmlForm = null;
        $htmlForm .= view('formulario.etiquetaFormulario')
        ->with('id_formulario', $idFormulario)
        ->with('id', $id)
        ->with('nomTabla', $name)
        ->renderSections()['apertura'];

        foreach ($formulario as $key => $record) {

            $vista = "formulario.{$record['tipo_campo']}";
            foreach ($queryData as $dataUpdate) {
                $htmlForm .= view(
                    $vista, [
                    'data' => $record,
                    'dataUpdate' => $dataUpdate
                    ]
                )->render();
            }
        }

        $htmlForm .= view('formulario.etiquetaFormulario')
        ->with('id_formulario', $idFormulario)
        ->with('id', $id)
        ->with('nomTabla', $name)
        ->renderSections()['cierre'];

        return view(
            'formulario.form', [
            'strform' => $htmlForm
            ]
        );

     }

    /**
     * Metodo update
     * Se encarga de recibir los datos
     * del formulario creado por el metodo edit
     * realizar validaciones
     * y salvar los datos
     * @param $request
     * @return boolean
     */
     public function update(Request $request, $id)
     {
        $tabla = "";
        $arrvalidacion = [];
        $query = $this->_model->where('nom_programa', $request->nom_programa)->get();

        foreach ($query as $nformulario) {

          $campo = $nformulario->nom_campo;
          $arrvalidacion[$campo] = "";

          if ($nformulario->primary_key === true) {
            $tabla = $nformulario->nom_tabla;
          }

          if ($nformulario->requerido === true) {
            $arrvalidacion[$campo] .= "required|";
          }

          if (!empty($nformulario->min_val) && $nformulario->min_val > 0) {
            $arrvalidacion[$campo] .= "min:{$nformulario->min_val}|";
          }

          if (!empty($nformulario->max_val) && $nformulario->max_val > 0) {
            $arrvalidacion[$campo] .= "max:{$nformulario->max_val}";
          }

          if (!empty($nformulario->tipo_campo == 'email')) {
            $arrvalidacion[$campo] .= "email|unique:$tabla";
          }

          if (!empty($nformulario->tipo_campo == 'moneda')) {
            $request->$campo = str_replace(',', '', $request->$campo);
            $request->merge([$campo => $request->$campo]);
          }
        }

        $datosValidados = request()->validate($arrvalidacion);

        $modelo = session('tablas')[$request->nameTable]['model'];
        $pk = $modelo->getKeyName();

        foreach ($query as $nformulario) {

          $campo = $nformulario->nom_campo;
          $value = $request->get($campo);

            if (Schema::hasColumn($tabla, $campo) && isset($value)) {
              $arrguardado[$campo] = $request->get($campo);
            }
        }

        $modelo::where($pk, $id)->update($arrguardado);

        return response()->json(
            [
              [
                'estadoRespuesta' => 'Actualizar',
                'respuesta' => $datosValidados,
              ]
            ]
        );
     }

     public function destroy(Request $request)
     {

      if ($request->ajax()) {
        $name = $request->get('modelo');
        $modelo = session('tablas')[$name]['model'];
        $registro = $modelo::findOrFail($request->id);
        $registro->delete();
      }

        //return "te juro por Dios que no voy as llorar";
     }

}
