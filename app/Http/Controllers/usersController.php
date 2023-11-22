<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\abastecimiento;
use App\Models\rol;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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
        $users = User::all();
        return response()->json($users,Response::HTTP_OK);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json(['message' => 'Esta es la respuesta de la API para crear usuarios'], 200);
    }

    /*public function create()
    {
        $rols = Rol::all();
        $abastecimientos = Abastecimiento::all();
    
        return response()->json(compact('rols', 'abastecimientos'));
    }*/
    
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
 */
    
/* 
    public function store(Request $request)
    {
        $user = new User();
        $user->nombres = $request->nombres;
        $user->apellidos = $request->apellidos;
        $user->edad = $request->edad;
        $user->telefono = $request->telefono;
        $user->email = $request->email;
        $user->password = Hash::make($request->password); // Utiliza Hash::make para encriptar la contraseña
    
        // Asigna una foto predeterminada
        $user->profile_picture = 'img/default_profile_picture.png';
    
        // Procesa y guarda la foto de perfil si se proporciona una
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }
    
        $user->save();
    
        return response()->json($user, Response::HTTP_CREATED);
    } */

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        
        $user = User::create([
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'edad' => $request->edad,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]); 

       

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'data' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function logins(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    
        $user = User::where('email', $request['email'])->firstOrFail();
    
        $token = $user->createToken('auth_token')->plainTextToken;
    
        return response()->json([
            'message' => 'Hi ' . $user->nombres,
            'accessToken' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);
    }

    public function logout(){

        auth()->user()->tokens()->delete();

        return[
            'message' => 'You have successfully logged out and the token was succesfully deleted'
        ];

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
    public function edit(User $user)
    {
        return response()->json(['user' => $user], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  public function update(Request $request, User $user)
{
    try {
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

        // Puedes personalizar la respuesta según tus necesidades
        return response()->json(['message' => 'Registro actualizado correctamente', 'user' => $user], 200);
    } catch (\Exception $e) {
        // Manejo de errores
        return response()->json(['error' => 'Error al actualizar el registro', 'message' => $e->getMessage()], 500);
    }
}
     

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

        $user->delete();
        
      return response()->json(null,Response::HTTP_NO_CONTENT);
    }
}
