<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\abastecimiento;
use App\Models\producto;
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
            'profile_picture' => 'img/default_profile_picture.png', // Ruta de la imagen por defecto
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
            'isLoggedIn' => true, // Agregamos un indicador de inicio de sesión
        ]);
    }

    public function logout(){

        auth()->user()->tokens()->delete();
        return [
            'message' => 'Logout successful',
            'isLoggedIn' => false, // Agregamos un indicador de cierre de sesión
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
    public function edit($id)
    {
        try {
            // Encuentra el usuario por su ID
            $user = User::findOrFail($id);
    
            // Puedes ajustar la respuesta según tus necesidades
            return response()->json(['user' => $user], Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            // Manejo de error cuando el usuario no existe
            return response()->json(['error' => 'Usuario no encontrado'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            // Manejo de otros errores
            return response()->json(['error' => 'Error al obtener el usuario', 'message' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, producto $producto)
    {
        // Validación de campos
        $request->validate([
            'nombres' => 'required|max:255',
            'tiempo_reclamo' => 'required|max:255',
            'precio' => 'required|integer',
            'descripcion' => 'required|max:255',
            'user_id' => 'required|integer',
            'nueva_imagen' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Ajusta según tus necesidades
        ]);
    
        // Actualiza los campos
        $producto->nombres = $request->nombres;
        $producto->tiempo_reclamo = $request->tiempo_reclamo;
        $producto->precio = $request->precio;
        $producto->descripcion = $request->descripcion;
        $producto->user_id = $request->user_id;
    
        // Verifica si se proporcionó una nueva imagen
        if ($request->hasFile('nueva_imagen')) {
            // Elimina la imagen antigua si existe
            if (Storage::exists('public/productos/' . $producto->imagen)) {
                Storage::delete('public/productos/' . $producto->imagen);
            }
    
            // Almacena la nueva imagen
            $imagenPath = $request->file('nueva_imagen')->storeAs('public/productos', time() . '_' . $request->file('nueva_imagen')->getClientOriginalName());
            $producto->imagen = basename($imagenPath);
        }
    
        $producto->save();
    
        return response()->json($producto, Response::HTTP_OK);
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
