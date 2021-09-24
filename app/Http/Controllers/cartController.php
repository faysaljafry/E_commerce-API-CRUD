<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Product;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;

class cartController extends Controller
{
    public function getCartItems(){
        $cart = Product::join('carts', 'products.id', '=', 'carts.product_id')
        ->get(['carts.id', 'products.p_name', 'products.p_color', 'products.price', 'products.d_price']);
        return response() -> json($cart);
    }

    public function addToCart(Request $request){
        $cartItem = new Cart;
        $cartItem -> product_id = $request -> product_id;
        $cartItem->save();
        $message = array('message' => 'Success!', 'title' => 'Added Product to Cart.');
        return response()->json($message);
    }

    public function deleteFromCart($id){
        //$id = $request->product_id;
        if(Cart::where('id', $id) -> exists()){
            $cartItem = Cart::findOrFail($id);
            $cartItem->delete();
            $message = array('message' => 'Found', 'title' => 'Deleted from Cart.');
            return response() -> json ($message);
        }else{
            $message = array('message' => 'Success', 'title' => 'Not Found');
            return response() -> json ($message);
        }
    }
}
