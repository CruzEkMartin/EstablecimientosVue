<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Establecimiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'categoria_id',
        'imagen_principal',
        'direccion',
        'colonia',
        'lat',
        'lng',
        'telefono',
        'descripcion',
        'apertura',
        'cierre',
        'uuid',
        'user_id'
    ];


    //relación para indicar que el establecimiento pertenece a una categoria y poder devolver el nombre 
    //de la categoria, en lugar de categoria_id, al consultar el modelo
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
