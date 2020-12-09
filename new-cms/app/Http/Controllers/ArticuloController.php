<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ArticuloModel;

class ArticuloController extends Controller
{

    public function getArticulo() {

        $articulos = ArticuloModel::all();

        return view('pages.articulos', array("articulos" => $articulos));

    }
    
}
