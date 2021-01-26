<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ArticuloModel;
use App\BlogModel;


class ArticuloController extends Controller
{

    public function index() {

        $articulos = ArticuloModel::all();
        $blog = BlogModel::all();

        return view('pages.articulos', array("articulos" => $articulos, "blog" => $blog));

    }
    
}
