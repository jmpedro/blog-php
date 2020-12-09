<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticuloModel extends Model
{
    protected $table = 'articulos';

    /* HACER UN INNER JOIN CON CATEGORIAS */
    public function categorias() {

        // Lo siguiente nos devuelve los datos de las dos tablas
        return $this->belongsTo('App\CategoriaModel', 'id_cat', 'id_categoria');

    }
}
