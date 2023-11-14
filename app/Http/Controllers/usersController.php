<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\abastecimiento;
use App\Models\rol;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Auth\User as AuthUser;

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

// Asignar una foto predeterminada
$users->profile_picture = 'img/default_profile_picture.png';

// Procesar y guardar la foto de perfil si se proporciona una
if ($request->hasFile('profile_picture')) {
    $path = $request->file('profile_picture')->store('profile_pictures', 'public');
    $users->profile_picture = $path;
}
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
        $user->nombres = $request->nombres;
        $user->apellidos = $request->apellidos;
        $user->edad = $request->edad;
        $user->telefono = $request->telefono;
        $user->email = $request->email;
        $user->password = $request->password;
    
        // Actualizar la foto de perfil si se proporciona una nueva
        if ($request->hasFile('profile_picture')) {
            // Eliminar la foto de perfil anterior si no es la predeterminada
            if ($user->profile_picture && $user->profile_picture !== 'img/default_profile_picture.png') {
                Storage::disk('public')->delete($user->profile_picture);
            }
            // Guardar la nueva foto de perfil
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        } elseif ($request->has('remove_profile_picture') && $request->remove_profile_picture == 1) {
            // Si se proporciona un campo remove_profile_picture y es igual a 1, elimina la foto de perfil
            if ($user->profile_picture && $user->profile_picture !== 'img/default_profile_picture.png') {
                Storage::disk('public')->delete($user->profile_picture);
                $user->profile_picture = null;
            }
        }
    
        $user->save();
    
        return redirect()->route('users.edit', ['user' => $user->id])->with('success', 'Registro actualizado correctamente');

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

public function dataUser()
{

$user= User::all();
return response()->json($user);

}

}
