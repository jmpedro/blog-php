<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AnuncioModel;

class AnuncioController extends Controller
{
    
    public function getAnuncios() {

        $anuncios = AnuncioModel::all();

        return view('pages.anuncios', array("anuncios" => $anuncios));

    }

}