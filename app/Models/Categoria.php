<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    //leer las rutas por slug, por defecto las modelos son consultados por su id, 
    //al crear la siguiente función se determina la consulta por algún otro campo de la tabla
    public function getRouteKeyName()
    {
        return 'slug';
    }


    //relacion uno a muchos (1:n) para categorias y establecimientos, una categoria puede tener muchos establecimientos
    public function establecimientos(){
        return $this->hasMany(Establecimiento::class);
    }
}
