<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Productos;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos = Productos::all();
        return response()->json(['productos'=>$datos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $extension = $request->file('imagen')->getClientOriginalExtension();
        $path = base_path().'/public/img/productos/';
        $name = "imagen_".date('Y_m_d_h_i_s').".".$extension;
        $request->file('imagen')->move($path,$name);
        $datos = new Productos();
        $datos->imagen = $name;
        $datos->nombre = $input['nombre'];
        $datos->descripcion = $input['descripcion'];
        $datos->precio = $input['precio'];
        $datos->idcategoria = $input['idcategoria'];
        $datos->save();
        return response()->json(['Mensaje'=>'Producto almacenado correctamente']);
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
        $datos = Productos::find($id);
        return response()->json(['producto' => $datos]);
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
        $input = $request->all();
        $datos = Productos::find($id);
        if(isset($input['imagen'])){
            $extension = $request->file('imagen')->getClientOriginalExtension();
            $path = base_path().'/public/img/productos/';
            $name = "imagen_".date('Y_m_d_h_i_s').".".$extension;
            $request->file("imagen")->move($path,$name);
            $datos->imagen=$name;
        }
        $datos->nombre = $input['nombre'];
        $datos->descripcion = $input['descripcion'];
        $datos->precio = $input['precio'];
        $datos->idcategoria = $input['idcategoria'];
        $datos->update();
        return response()->json(['Mensaje'=>'El producto se ha actualizado correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $datos = Productos::find($id);
        $datos->delete();
        return response()->json(['Mensaje' => 'Producto eliminado correctamente']);
    }
}
