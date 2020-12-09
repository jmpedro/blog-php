<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoriaModel;

class CategoriaController extends Controller
{
    public function getCategoria() {

        $categorias = CategoriaModel::all();
    
        return view('pages.categorias', array("categorias" => $categorias));

    }
}