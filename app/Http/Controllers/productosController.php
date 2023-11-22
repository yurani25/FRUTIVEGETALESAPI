<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\producto;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Response;


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
    public function catalogo(Request $request)
    {
        $productos = Producto::all();
    
        // Puedes agregar lógica adicional aquí para procesar los datos según tus necesidades
    
        return response()->json(['index' => $productos], 200);
    }

    
    public function inorganico()
    {
        $productos = producto::all();
       
        foreach($productos as $producto){
             if($producto->imagen){
            $producto->imagen = asset('storage/productos/' . $producto->imagen);
            }
         } 
          //  return $productos;
     return view('inorganico',compact('productos'));
     
    
    }

 

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
  return view('productos.create' , compact('users'));

     
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
            'nombres' => 'required|max:255',
            'tiempo_reclamo' => 'required|max:255',
            /* 'image' => 'required|max:255', */
            'precio' => 'required|integer',
            'descripcion' => 'required|max:255',
            'user_id' => 'required|integer' 
        
        ]);


          // Subir y almacenar la imagen
       /* if ($request->hasFile('imagen')) {
            $imageName = time() . '.' . $request->file('imagen')->getClientOriginalExtension();
            $imagenPath = $request->file('imagen')->storeAs('productos', $imageName, 'public');
            $productos->imagen = $imageName;
           //$product->image = $imagenPath;

        }*/
        $productos = producto::create($request->all());
        return response()->json($productos, Response::HTTP_CREATED);

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //para detalle del producto
    public function show($id)
    {
        $producto = producto::find($id);
    
        if (!$producto) {
            abort(404); // Mostrar una página de error 404 si el producto no se encuentra
        }
    
        return view('productos.detalle', compact('producto' ));
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
 
        public function update(Request $request, producto $producto)
        {
        
         /*    $id = (int)$request->id; */
        
            $request->validate([
                'nombres' => 'required|max:255',
                'tiempo_reclamo' => 'required|max:255',
                /* 'image' => 'required|max:255', */
                'precio' => 'required|integer',
                'descripcion' => 'required|max:255',
                'user_id' => 'required|integer' 
            
            ]);


   // Verificar si se proporcionó una nueva imagen
      /*  if ($request->hasFile('nueva_imagen')) {
            $imageName = time() . '.' . $request->file('nueva_imagen')->getClientOriginalExtension();
            $imagenPath = $request->file('nueva_imagen')->storeAs('productos', $imageName, 'public');
            $producto->imagen = $imageName; 
        }*/
    
        $producto->update($request->all());

    return response()->json($producto, Response::HTTP_OK);

        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(producto $producto)
    {
        
      /*   if ($product->image) {
            Storage::delete('public/product/' . $product->image);
        } */
    
        $producto->delete();
        
      return response()->json(null,Response::HTTP_NO_CONTENT);
    }

}













