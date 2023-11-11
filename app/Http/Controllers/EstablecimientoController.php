<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\Establecimiento;
use App\Models\Imagen;
use Intervention\Image\Facades\Image;

class EstablecimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //consultar las categorias
        $categorias = Categoria::all();
        return view('establecimientos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validaciones .... en categorias_id se valida sea requerido y que exista en la tabla categorias a traves del campo id
        $data = $request->validate([
            'nombre' => 'required',
            'categoria_id' => 'required|exists:categorias,id',
            'imagen_principal' => 'required|image|max:3000',
            'direccion' => 'required',
            'colonia' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'telefono' => 'required|numeric',
            'descripcion' => 'required|min:50',
            'apertura' => 'date_format:H:i',
            'cierre' => 'date_format:H:i|after:apertura',
            'uuid' => 'required|uuid'
        ]);

        //guardar la imagen
        $ruta_imagen = $request['imagen_principal']->store('principales', 'public');

        //resize a la imagen con intervention/image
        $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(800, 600);
        $img->save();

        //guardar en la base de datos
        $establecimiento = new Establecimiento($data);
        $establecimiento->nombre = $data['nombre'];
        $establecimiento->categoria_id = $data['categoria_id'];
        $establecimiento->imagen_principal = $ruta_imagen;
        $establecimiento->direccion = $data['direccion'];
        $establecimiento->colonia = $data['colonia'];
        $establecimiento->lat = $data['lat'];
        $establecimiento->lng = $data['lng'];
        $establecimiento->telefono = $data['telefono'];
        $establecimiento->descripcion = $data['descripcion'];
        $establecimiento->apertura = $data['apertura'];
        $establecimiento->cierre = $data['cierre'];
        $establecimiento->uuid = $data['uuid'];
        $establecimiento->user_id = auth()->user()->id;
        $establecimiento->save();


        // auth()->user()->establecimiento()->create([
        //     'nombre' => $data['nombre'],
        //     'categoria_id' => $data['categoria_id'],
        //     'imagen_principal' => $data['imagen_principal'],
        //     'direccion' => $data['direccion'],
        //     'colonia' => $data['colonia'],
        //     'lat' => $data['lat'],
        //     'lng' => $data['lng'],
        //     'telefono' => $data['telefono'],
        //     'descripcion' => $data['descripcion'],
        //     'apertura' => $data['apertura'],
        //     'cierre' => $data['cierre'],
        //     'uuid' => $data['uuid']
        // ]);

        return back()->with('estado', 'Tu información se almacenó correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function show(Establecimiento $establecimiento)
    {
        //
        return view('lector.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Establecimiento $establecimiento)
    {
        //
        $categorias = Categoria::all();
        //obtener establecimiento
        $establecimiento = auth()->user()->establecimiento;
        //sobreescribimos la hora de apertura y cierre para devolver solo la hora y los minutos
        $establecimiento->apertura = date('H:i', strtotime($establecimiento->apertura));
        $establecimiento->cierre = date('H:i', strtotime($establecimiento->cierre));

        //obtiene las imagenes del establecimiento para mostrarlo en dropzone
        $imagenes = Imagen::where('id_establecimiento', $establecimiento->uuid)->get();
        //dd($imagenes);

        return view('establecimientos.edit', compact('categorias','establecimiento','imagenes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Establecimiento $establecimiento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Establecimiento $establecimiento)
    {
        //
    }
}
