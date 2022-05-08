<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    
    function __construct()
    {
         $this->middleware('permission:usuario-listar|usuario-crear|usuario-editar|usuario-eliminar', ['only' => ['index','store']]);
         $this->middleware('permission:usuario-crear', ['only' => ['create','store']]);
         $this->middleware('permission:usuario-editar', ['only' => ['edit','update']]);
         $this->middleware('permission:usuario-eliminar', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {        
        $texto=trim($request->get('texto'));
        $registros = User::orderBy('id','DESC')
                            ->where('name','LIKE','%'.$texto.'%')
                            ->paginate(10);
        return view('usuario.index',compact('registros','texto'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('usuario.create',compact('roles'));
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        $registro = User::create($input);
        $registro->assignRole($request->input('roles'));
    
        return redirect()->route('usuario.index')
                        ->with('mensaje','Registro '.$registro->name.' agregado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $registro = User::find($id);
        return view('usuario.show',compact('registro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $registro = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $usuarioRoles = $registro->roles->pluck('name','name')->all();    
        return view('usuario.edit',compact('registro','roles','usuarioRoles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $registro = User::find($id);
        $registro->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $registro->assignRole($request->input('roles'));
    
        return redirect()->route('usuario.index')
                            ->with('mensaje','Registro '.$registro->name.' actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }
}
