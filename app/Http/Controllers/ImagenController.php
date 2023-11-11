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

        //se obtiene la ruta y el uuid de la imagen 
        $imagen = $request->get('imagen');

        //elimina la imagen del servidor y de la base de datos
        if (File::exists('storage/' . $imagen)) {
            //elimina la imagen del servidor
            File::delete('storage/' . $imagen);

            //elimina la imagen de la base de datos
            Imagen::where('ruta_imagen', $imagen )->delete();

            $respuesta = [
                'mensaje' => 'Imagen Eliminada',
                'imagen' => $imagen
            ];

        }

        //enviamos la respuesta al front end. Se recibe en la función removedfile del archivo resources/js/dropzone.js
        return response()->json($respuesta);
    }
}
