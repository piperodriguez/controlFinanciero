<?php

namespace App\Http\Controllers\moduloAdminGastos;

use App\Modelos\Pagos;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;

/**
 * @author frodriguez (varasjuan367@gmail.com)
 * Controlador pagosctr contiene la logica
 * de los pagos ingresados al aplicativo.
 */

class pagosctr extends Controller
{

    private $_model;

    function __construct()
    {
        $this->middleware('auth');
        $this->_model = new Pagos();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $data = Pagos::latest()->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-dark btn-sm editUsuario"><i class="fas fa-user-edit"></i></a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteUser"><i class="fas fa-user-times"></i></a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        $users = [];
        return view('pagos', compact('users'));

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pagoId = $request->id;



        $pago   =   Pagos::updateOrCreate(['id' => $pagoId],
                            [
                                'user_id' => $request->user_id,
                                'descripcion' => $request->descripcion,
                                'valor' => $request->valor,
                            ]
                        );

        return response()->json(['success'=>'Pago saved successfully.']);

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        echo "hello world";
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pago = Pagos::find($id);
        return response()->json($pago);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pagos::find($id)->delete();

        return response()->json(['success'=>'pago deleted!']);
    }
}
