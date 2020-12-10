<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BannerModel;

class BannerController extends Controller
{
    
    public function index() {

        $banners = BannerModel::all();

        return view('pages.banner', array("banners" => $banners));

    }

}
