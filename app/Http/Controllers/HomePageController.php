<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class HomePageController extends Controller
{
    //
    public function index(){
    	//pages = nama folder
    	//homepage = nama file homepage
    	//dikasih . untuk masuk folder
    	 return view('pages.homepage');
    }
}
