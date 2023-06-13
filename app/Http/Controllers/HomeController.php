<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        if(Auth::guard('umkm')->check()){
            return view('home.umkm');
        }else{
            return view('home.admin');
        }
    }
}
