<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BannerModel;
use App\BlogModel;


class BannerController extends Controller
{
    
    public function index() {

        $banners = BannerModel::all();
        $blog = BlogModel::all();

        return view('pages.banner', array("banners" => $banners, "blog" => $blog));

    }

}
