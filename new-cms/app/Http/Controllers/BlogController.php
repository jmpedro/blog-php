<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BlogModel;

class BlogController extends Controller
{
    
    public function getBlog() {

        // Para indicar que queremos hacer un select de todo lo que hay en la tabla, llamamos a la clase del modelo y al método estático all()
        $blog = BlogModel::all();

        return view('pages.blog', array("blog" => $blog));

    }

}
