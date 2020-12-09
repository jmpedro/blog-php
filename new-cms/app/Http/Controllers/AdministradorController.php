<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdministradorModel;

class AdministradorController extends Controller
{
    public function getUsers() {

        $users = AdministradorModel::all();

        return view('pages.administradores', array("users" => $users));

    }
}
