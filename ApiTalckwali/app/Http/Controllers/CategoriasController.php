<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Categorias;
use App\models\Productos;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos = Categorias::all();
        return response()->json(['categorias' => $datos]);
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
        $path = base_path().'/public/img/categorias/';
        $name = "imagen_".date('Y_m_d_h_i_s').".".$extension;
        $request->file("imagen")->move($path,$name);
        $datos = new Categorias();
        $datos->imagen = $name;
        $datos->nombre = $input['nombre'];
        $datos->save();
        return response()->json(['Mensaje'=>'Categoria almacenada correctamente']);
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
        $datos = Categorias::find($id);
        return response()->json(['Categoria'=>$datos]);
    }

        /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ViewProductsCategories($id)
    {
        $datos = Productos::where('idcategoria','=',$id )->get();
        return response()->json(['productos' => $datos]);
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
        $datos = Categorias::find($id);
        if(isset($input['imagen'])){
            $extension = $request->file('imagen')->getClientOriginalExtension();
            $path = base_path().'/public/img/categorias/';
            $name = "imagen_".date('Y_m_d_h_i_s').".".$extension;
            $request->file("imagen")->move($path,$name);
            $datos->imagen=$name;
        }
        $datos->nombre = $input['nombre'];
        $datos->update();
        return response()->json(['Mensaje'=>'La categoria se ha actualizado correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $datos = Categorias::find($id);
        $datos->delete();
        return response()->json(['Mensaje'=>'Registro eliminado correctamente']);
    }
}
