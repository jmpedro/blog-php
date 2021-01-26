<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoriaModel;
use App\BlogModel;


class CategoriaController extends Controller
{
    public function index() {

        $categorias = CategoriaModel::all();
        $blog = BlogModel::all();
    
        return view('pages.categorias', array("categorias" => $categorias, "blog" => $blog));

    }
}
