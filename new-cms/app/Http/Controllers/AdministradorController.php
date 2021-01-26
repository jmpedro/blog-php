<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdministradorModel;
use App\BlogModel;


class AdministradorController extends Controller
{
    public function index() {

        $users = AdministradorModel::all();
        $blog = BlogModel::all();

        return view('pages.administradores', array("users" => $users, "blog" => $blog));

    }
}
