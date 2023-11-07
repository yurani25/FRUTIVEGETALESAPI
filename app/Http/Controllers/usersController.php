<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\abastecimiento;
use App\Models\rol;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Authenticatable;

class usersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=user::all();
        return view('users.index' , compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rols = rol::all();
        $abastecimientos = abastecimiento::all();
        return view('users.create', compact('rols', 'abastecimientos'));//
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request )
    {
        $users = new User();
        $users->nombres = $request->nombres;
        $users->apellidos = $request->apellidos;
        $users->edad = $request->edad;
        $users->telefono = $request->telefono;
        $users->email = $request->email;
        $users->password = bcrypt($request->password); // Encripta la contraseña
       // $users->abastecimiento_id = $request->abastecimiento_id;
        //$users->rol_id = $request->rol_id;
        $users->save();
        return redirect()->route('login', $users);
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( user $user)
    {

        $rols = Rol::all(); 
        $abastecimientos = Abastecimiento::all(); 
        return view('users.edit', compact('user', 'rols','abastecimientos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        $user->nombres=$request->nombres;
        $user->apellidos=$request->apellidos;
        $user->edad=$request->edad;
        $user->telefono=$request->telefono;
        $user->email=$request->email;
        $user->password =$request->password;
       // $user->abastecimiento_id=$request->abastecimiento_id;
        //$user->rol_id=$request->rol_id;
        $user->save();
    
        return redirect()->route('users.index')->with('success', 'Registro actualizado correctamente');

    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id)->delete();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado exitosamente');
    }
}
