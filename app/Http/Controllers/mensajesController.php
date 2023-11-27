<?php

namespace App\Http\Controllers;

use App\Models\mensaje;
use Illuminate\Http\Response;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class mensajesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mensajes = mensaje::with('user')->get();
        return response()->json($mensajes,Response::HTTP_OK);
    }
 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('mensajes.create', compact('users') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


     public function store(Request $request)
     {
         $request->validate([
             'nombre_chat' => 'required|max:255',
             'user_id' => 'required|integer' 
         
         ]);
 
         $mensajes = mensaje::create($request->all());
         return response()->json($mensajes, Response::HTTP_CREATED);
 
         
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
    public function edit(mensaje $mensaje)
    {
        $users = User::all(); 
        return view('mensajes.edit', compact('mensaje', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, mensaje $mensaje)
    {
        $mensaje->nombre_chat = $request->nombre_chat;
        $mensaje->user_id=$request->user_id;
        $mensaje->save();
        return redirect()->route('mensajes.index')->with('success', 'Registro actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mensaje = mensaje::find($id)->delete();

        return redirect()->route('mensajes.index')->with('success', 'Usuario eliminado exitosamente');
    }
}
