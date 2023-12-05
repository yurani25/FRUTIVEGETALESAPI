<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\producto;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;


class productosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
public function index()
    {
        $product = producto::with('user')->get();
        return response()->json($product,Response::HTTP_OK);
 
    }

  /*   public function catalogo()
    {
        $productos = producto::all();
       
        foreach($productos as $producto){
             if($producto->imagen){
            $producto->imagen = asset('storage/productos/' . $producto->imagen);
            }
         } 
          //  return $productos;
     return view('index',compact('productos'));
     
    
    } */
 /*    public function catalogo(Request $request)
    {
        $productos = Producto::all();
    
        // Puedes agregar lógica adicional aquí para procesar los datos según tus necesidades
    
        return response()->json(['index' => $productos], 200);
    } */


    public function catalogo()
    {
        $productos = producto::all();
        
        foreach ($productos as $producto) {
            if ($producto->imagen) {
                $producto->imagen = asset('storage/productos/' . $producto->imagen);
            }
        }
    
        // Devuelve los productos como respuesta JSON
        return response()->json(['productos' => $productos], 200);
    }




    
    public function inorganico()
    {
        $productos = producto::all();
       
        foreach($productos as $producto){
             if($producto->imagen){
            $producto->imagen = asset('storage/productos/' . $producto->imagen);
            }
         } 
         
        // Devuelve los productos como respuesta JSON
        return response()->json(['productos' => $productos], 200);
     
    
    }

 

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|max:255',
            'tiempo_reclamo' => 'required|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Ajusta las extensiones, el tamaño máximo y otras reglas según tus necesidades
            'precio' => 'required|integer',
            'descripcion' => 'required|max:255',
            'user_id' => 'required|integer' 
        ]);
    
        $productoData = [
            'nombres' => $request->nombres,
            'tiempo_reclamo' => $request->tiempo_reclamo,
            'precio' => $request->precio,
            'descripcion' => $request->descripcion,
            'user_id' => $request->user_id,
        ];
    
        // Verificar si se proporcionó una imagen
        if ($request->hasFile('imagen')) {
            // Subir y almacenar la imagen localmente
            $imagePath = $request->file('imagen')->store('productos', 'public');
            $productoData['imagen'] = asset('storage/' . $imagePath);
        }
    
        // Crear el producto con o sin URL de imagen
        $producto = producto::create($productoData);
    
        return response()->json($producto, Response::HTTP_CREATED);
    }
    



   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function show($id)
     {
         $producto = Producto::find($id);
     
         if (!$producto) {
             return Response::json(['error' => 'Producto no encontrado'], 404);
         }
     
         return Response::json(['producto' => $producto], 200);
     }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){

        $producto = producto::with('user')->find($id);
        if (!$producto) {
            return response()->json(['error' => 'Usuario no encontrado'], Response::HTTP_NOT_FOUND);
        }

      return response()->json($producto,Response::HTTP_OK);

       
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
    
        $request->validate([
            'nombres' => 'required|max:255',
            'tiempo_reclamo' => 'required|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'precio' => 'required|integer',
            'descripcion' => 'required|max:255',
            'user_id' => 'required|integer' 
        ]);
    
        // Verificar si se ha cargado una nueva imagen
        if ($request->hasFile('imagen')) {
            // Eliminar la imagen anterior si existe
            if ($producto->imagen) {
                Storage::disk('public')->delete(str_replace(asset('storage/'), '', $producto->imagen));
            }
    
            // Guardar la nueva imagen
            $imagePath = $request->file('imagen')->store('productos', 'public');
            $producto->imagen = asset('storage/' . $imagePath);
        }
    
        // Llenar el modelo con los demás datos
        $producto->fill($request->except('imagen'));
        $producto->save();
    
        return response()->json($producto, Response::HTTP_OK);
    }
    
    
    
    /* public function update(Request $request, $id)
     {

        $request->validate([
            'nombres' => 'required|max:255',
            'tiempo_reclamo' => 'required|max:255',
            'precio' => 'required|integer',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'descripcion' => 'required|max:255',
            'user_id' => 'required|integer'
        ]);
    
        // Obtener el producto por ID
        $producto = Producto::find($id);
    
        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], Response::HTTP_NOT_FOUND);
        }
       // Verificar si se proporcionó una nueva imagen
       if ($request->hasFile('imagen')) {
        // Eliminar la imagen anterior si existe
        Storage::disk('public')->delete($producto->imagen);

        // Subir y almacenar la nueva imagen localmente
        $imagePath = $request->file('imagen')->store('productos', 'public');

        // Actualizar la URL de la imagen en la base de datos
        $producto->update(['imagen' => asset('storage/' . $imagePath)]);
    }
        // Actualizar los campos del producto
        $producto->update([
            'nombres' => $request->nombres,
            'tiempo_reclamo' => $request->tiempo_reclamo,
            'precio' => $request->precio,
            'imagen' => asset('storage/' . $imagePath),
            'descripcion' => $request->descripcion,
            'user_id' => $request->user_id,
        ]);
    
     
    
        return response()->json($producto, Response::HTTP_OK);
        /*
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
     }*/
     

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $producto)
    {
        
      /*   if ($product->image) {
            Storage::delete('public/product/' . $product->image);
        } */
    
        //$producto->delete();

        $product = producto::findOrFail($producto);
        $product->delete();
        
      return response()->json([], 204);
    }

}













