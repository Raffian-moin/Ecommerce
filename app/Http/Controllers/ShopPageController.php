<?php

namespace App\Http\Controllers;

use App\product;
use Illuminate\Http\Request;

class ShopPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=product::inRandomOrder()->take(12)->get();
        return view("partials.shop",compact("products"));
    }

    public function show($slug){
        $product=product::where('slug',$slug)->firstOrFail();
        $mightLikeAlso=product::where('slug','!=',$slug)->MightAlsoLike()->get();
        return view('partials.product',compact("product","mightLikeAlso"));
    }
}
