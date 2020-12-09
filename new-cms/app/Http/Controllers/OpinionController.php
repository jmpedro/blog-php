<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OpinionModel;

class OpinionController extends Controller
{
    public function getOpinion() {

        $opiniones = OpinionModel::all();

        return view('pages.opiniones', array("opiniones" => $opiniones));

    }
}