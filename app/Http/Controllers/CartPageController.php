<?php

namespace App\Http\Controllers;

use App\Http\Requests\checkRequest;
use App\product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $mightLikeAlso=product::MightAlsoLike()->get();
        return view("partials.cart",compact("mightLikeAlso"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(checkRequest $request)
    { 
        $duplicate = Cart::search(function ($cartItem, $rowId) use ($request) {
            return $cartItem->id === $request->id;
        });

        if($duplicate->isNotEmpty()){

           return redirect()->route('cart.index')->with('success','Item is already in the cart!!');
        }   

            Cart::add($request->id, $request->name,1, $request->price)->associate('App\product');

            return redirect()->route('cart.index')->with('success','Item is added successfully!!');
        }
        

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);

        return redirect()->route('cart.index')->with('success','Item is deleted successfully!!'); 
    }


    public function saveForLater($id)
    { 
        $item = Cart::get($id);

        Cart::remove($id);

         $duplicate = Cart::instance('saveForLater')->search(function ($cartItem, $rowId) use ($id) {
            return $rowId === $id;
        });

        if($duplicate->isNotEmpty()){

           return redirect()->route('cart.index')->with('success','Item is already in the save for later!!');
        }
            Cart::instance('saveForLater')->add($item->id, $item->name,1, $item->price)->associate('App\product');

            return redirect()->route('cart.index')->with('success','Item is save for later successfully!!'); 

        
}

}
