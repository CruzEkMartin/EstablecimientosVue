<?php

namespace App\Http\Controllers;

use App\Models\Imagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{

    public function store(Request $request)
    {
        //leer la imagen
        $ruta_imagen =  $request->file('file')->store('establecimientos', 'public');

        //cropping y resize a la imagen
        $imagen = Image::make(public_path("storage/{$ruta_imagen}"))->fit(800, 450);
        $imagen->save();


        //almacenar con el modelo 
        $imagenDB = new Imagen;
        $imagenDB->id_establecimiento = $request['uuid'];
        $imagenDB->ruta_imagen = $ruta_imagen;
        $imagenDB->save();

        //retornar respuesta
        $respuesta = [
            'archivo' => $ruta_imagen
        ];

        //enviamos la respuesta al front end. Se recibe en la función success del archivo resources/js/dropzone.js
        return response()->json($respuesta);
    }

    public function destroy(Request $request)
    {

        $imagen = $request->get('imagen');

        if (File::exists('storage/' . $imagen)) {
            File::delete('storage/' . $imagen);
        }

        $respuesta = [
            'mensaje' => 'Imagen Eliminada',
            'imagen' => $imagen
        ];

        $imagenEliminar = Imagen::where('ruta_imagen', '=', $imagen)->firstOrFail();
        Imagen::destroy($imagenEliminar->id);

        //enviamos la respuesta al front end. Se recibe en la función removedfile del archivo resources/js/dropzone.js
        return response()->json($respuesta);
    }
}
