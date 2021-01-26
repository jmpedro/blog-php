<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OpinionModel;
use App\BlogModel;


class OpinionController extends Controller
{
    public function index() {

        $opiniones = OpinionModel::all();
        $blog = BlogModel::all();

        return view('pages.opiniones', array("opiniones" => $opiniones, "blog" => $blog));

    }
}
