<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\Establecimiento;

class APIController extends Controller
{
    //obtener todas las categorias
    public function categorias()
    {
        $categorias =Categoria::all();
        return response()->json($categorias);
    }

    //muesta los entablecimientos de la categoria indicada
    public function categoria(Categoria $categoria)
    {
        
//se devuelve todos los datos de la tabla del establecimiento así como los todos los datos de la tabla de la categoria relacionada 
        $establecimientos = Establecimiento::where('categoria_id', $categoria->id)->with('categoria')->get();
        return response()->json($establecimientos);
    }
}