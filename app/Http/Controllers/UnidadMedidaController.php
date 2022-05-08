<?php

namespace App\Http\Controllers;

use App\Models\UnidadMedida;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use DataTables;
use Validator;

class UnidadMedidaController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:unidadMedida-listar|unidadMedida-crear|unidadMedida-editar|unidadMedida-eliminar', ['only' => ['index']]);
         $this->middleware('permission:unidadMedida-crear', ['only' => ['store']]);
         $this->middleware('permission:unidadMedida-editar', ['only' => ['edit','store']]);
         $this->middleware('permission:unidadMedida-eliminar', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(request()->ajax()) {
            $registros = UnidadMedida::select(['id', 'nombre']);
            return Datatables::of($registros)
            ->addColumn('action', 'unidad-medida.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);            
        }
        return view('unidad-medida.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|unique:unidades_medida,nombre',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ]);
        }
        $id = $request->id;
        $registro   =   UnidadMedida::updateOrCreate(
                    [
                     'id' => $id
                    ],
                    [
                    'nombre' => $request->nombre
                    ]);        
        return Response()->json($registro);        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UnidadMedida  $unidadMedida
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $where = array('id' => $request->id);
        $registro  = UnidadMedida::where($where)->first();
     
        return Response()->json($registro);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UnidadMedida  $unidadMedida
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $registro = UnidadMedida::where('id',$request->id)->delete();
     
        return Response()->json($registro);
    }
}
