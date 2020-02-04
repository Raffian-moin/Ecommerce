<?php

namespace App\Http\Controllers;

use App\product;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=product::inRandomOrder()->take(8)->get();
        return view("partials.main",compact("products"));
    }

   
   
}
