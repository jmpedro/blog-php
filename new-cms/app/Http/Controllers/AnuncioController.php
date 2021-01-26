<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AnuncioModel;
use App\BlogModel;


class AnuncioController extends Controller
{
    
    public function index() {

        $anuncios = AnuncioModel::all();
        $blog = BlogModel::all();

        return view('pages.anuncios', array("anuncios" => $anuncios, "blog" => $blog));

    }

}
