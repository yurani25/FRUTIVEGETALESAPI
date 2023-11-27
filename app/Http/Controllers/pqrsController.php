<?php

namespace App\Http\Controllers;

use App\Models\pqr;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class pqrsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 
    public function index()
    {
        $pqrs = pqr::with('user')->get();
        return response()->json($pqrs,Response::HTTP_OK);
 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
/*     public function create()
    {
        $usuarios = User::all(); // Obtén la lista de usuarios registrados
    
        return view('pqrs.create', compact('usuarios'));
    } */
    public function create()
    {
        $users = User::all();
  return view('pqrs.create' , compact('users'));

     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $pqr = Pqr::create([
                'user_id' => $request->user_id,
                'motivo' => $request->motivo,
                'tipo' => $request->tipo,
            ]);
    
            // Puedes personalizar el mensaje según tus necesidades
            return response()->json(['message' => 'La PQRS se ha enviado correctamente', 'pqr' => $pqr], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            // Manejo de errores
            return response()->json(['error' => 'Error al procesar la solicitud', 'message' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 /*    public function edit($id)
    {
        try {
            // Encuentra el PQRS por su ID
            $pqr = pqr::findOrFail($id);
    
            // Obtén la lista de usuarios registrados
            $usuarios = User::all();
    
            // Puedes ajustar la respuesta según tus necesidades
            return response()->json(['pqr' => $pqr, 'usuarios' => $usuarios], Response::HTTP_OK);
        } catch (\Exception $e) {
            // Manejo de errores
            return response()->json(['error' => 'Error al obtener el PQRS', 'message' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    } */
    
    public function edit($id){

        $pqr = pqr::with('user')->find($id);
        if (!$pqr) {
            return response()->json(['error' => 'Usuario no encontrado'], Response::HTTP_NOT_FOUND);
        }

      return response()->json($pqr,Response::HTTP_OK);

       
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pqr $pqr)
{
    try {
        // No necesitas buscar el PQRS ya que Laravel inyectará automáticamente el modelo correcto
        $pqr->user_id = $request->user_id;
        $pqr->motivo = $request->motivo;
        $pqr->tipo = $request->tipo;
        $pqr->save();

        return response()->json(['message' => 'Registro actualizado correctamente'], Response::HTTP_OK);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error al actualizar el PQRS.'], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}


    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function destroy(pqr $pqr)
    {

        $pqr->delete();
        
      return response()->json(null,Response::HTTP_NO_CONTENT);
    }
}
