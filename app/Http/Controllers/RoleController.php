<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class RoleController extends Controller
{
    
    function __construct()
    {
         $this->middleware('permission:rol-listar|rol-crear|rol-editar|rol-eliminar', ['only' => ['index','store']]);
         $this->middleware('permission:rol-crear', ['only' => ['create','store']]);
         $this->middleware('permission:rol-editar', ['only' => ['edit','update']]);
         $this->middleware('permission:rol-eliminar', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $texto=trim($request->get('texto'));
        $registros = Role::orderBy('id','DESC')
                            ->where('name','LIKE','%'.$texto.'%')
                            ->paginate(10);
        return view('rol.index',compact('registros','texto'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::get();
        return view('rol.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
    
        $registro = Role::create(['name' => $request->input('name')]);
        $registro->syncPermissions($request->input('permission'));
    
        return redirect()->route('rol.index')
                        ->with('mensaje','Registro '.$registro->name.' agregado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();
    
        return view('roles.show',compact('role','rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $registro = Role::find($id);
        $permissions = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
    
        return view('rol.edit',compact('registro','permissions','rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
    
        $registro = Role::find($id);
        $registro->name = $request->input('name');
        $registro->save();
    
        $registro->syncPermissions($request->input('permission'));
    
        return redirect()->route('rol.index')
                        ->with('mensaje','Registro '.$registro->name.' actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $registro=Role::findOrFail($id);
            $registro->delete();
            return redirect()->route('rol.index')
                        ->with('mensaje','Registro '.$registro->name.' eliminado correctamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('rol.index')->with('error','No se puede eliminar el registro '.$registro->codigo.' - '.$registro->nombre.' porque esta siendo usado.');
        }
    }
}
