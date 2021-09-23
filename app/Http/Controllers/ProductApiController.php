<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    public function getProduct($id){
        if(Product::where('id', $id) -> exists()){
            $product = Product::find($id);
            return response() -> json($product);
        } else{
            return response() -> json (["Message", "Could not find Product"]);
        }
    }
    public function getAllProducts(){
        $product = Product::all();
        if($product){
            return response() -> json($product);
        }else {
            return response() -> json(["Message" => "Not found"]);
        }
    }
    public function createProduct(Request $request){
        $product = new Product;
        $product->p_name = $request->p_name;
        $product -> p_color = $request->p_color;
        $product -> p_code = $request -> p_code;
        $product -> category_id = $request -> category_id;
        $product->save();
        return response() -> json(["message" => "Product has been added."]);
    }
    public function updateProduct(Request $request, $id){
        if(Product::where('id', $id) -> exists()){
            $product = Product::find($id);
            $product->p_name = is_null($request->p_name) ? $product->p_name:$request->p_name;
            $product->p_color = is_null($request->p_color) ? $product->p_color:$request->p_color;
            $product->p_code = is_null($request->p_code) ? $product->p_code:$request->p_code;
            return response() -> json(["Messsage" => "Product has been Updated."]);
        } else{
            return response () -> json(["Message" => "Produnt could not be found."]);
        }
    }
    public function deleteProduct($id){
        if(Product::where('id', $id) -> exists()){
            $product = Product::findOrFail($id);
            $product->delete();
            return response() -> json(["Message" => "The Product has been deleted."]);
        } else{
            return response() -> json(["Message" => "The Product either was deleted or doesnt exist."]);
        }
    }
}
