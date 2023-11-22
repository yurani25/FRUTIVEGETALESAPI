<?php

namespace App\Http\Controllers;

use App\Models\abastecimiento;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class AbastecimientosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abastecimientos = Abastecimiento::all();
    
        return response()->json($abastecimientos, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  // API
public function create()
{
    return response()->json(['message' => 'Acción no permitida en la API. Use un cliente web para crear recursos.'], 403);
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
// Controlador en la API
public function store(Request $request)
{
    try {
        $abastecimiento = new Abastecimiento();
        $abastecimiento->nombre = $request->nombre;
        $abastecimiento->ubicacion = $request->ubicacion;
        $abastecimiento->horario_atencion = $request->horario_atencion;
        $abastecimiento->save();

        return response()->json(['message' => 'Abastecimiento creado correctamente', 'abastecimiento' => $abastecimiento], 201);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error al crear el abastecimiento'], 500);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Abastecimiento $abastecimiento)
    {
        return response()->json($abastecimiento, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Abastecimiento $abastecimiento)
    {
        try {
            $abastecimiento->nombre = $request->nombre;
            $abastecimiento->ubicacion = $request->ubicacion;
            $abastecimiento->horario_atencion = $request->horario_atencion;
            $abastecimiento->save();
    
            return response()->json(['message' => 'Registro actualizado correctamente', 'abastecimiento' => $abastecimiento], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar el registro'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $abastecimiento = abastecimiento::find($id)->delete();

        return redirect()->route('abastecimientos.index')->with('success', 'Usuario eliminado exitosamente');
    }
}
