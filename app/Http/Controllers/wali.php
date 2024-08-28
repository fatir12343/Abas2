<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Wali extends Controller
{
    public function index(){
        return view('wali.wali');
    }
}
