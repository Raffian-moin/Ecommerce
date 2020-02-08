<?php

namespace App\Http\Controllers;


use App\product;
use Gloudemans\Shoppingcart\Facades\Cart;

use Illuminate\Http\Request;

class saveForLaterPageController extends Controller
{
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::instance('saveForLater')->remove($id);

        return redirect()->route('cart.index')->with('success','Item is deleted successfully!!'); 
    }


    public function switchToCart($id){

    	$item = Cart::instance('saveForLater')->get($id);

        Cart::instance('saveForLater')->remove($id);

    	$duplicate = Cart::instance('default')->search(function ($cartItem, $rowId) use ($id) {
            return $rowId === $id;
        });

        if($duplicate->isNotEmpty()){

           return redirect()->route('cart.index')->with('success','Item is already in the save for later!!');
        }

            Cart::instance('default')->add($item->id, $item->name,1, $item->price)->associate('App\product');

            return redirect()->route('cart.index')->with('success','Item is save for later successfully!!');

    }
}
