<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    //
    public function getCategory(Request $request, $id){
        if(Category::where('id', $id) -> exists()){
            $category = Category::find($id);
            return response() -> json($category);
        } else{
            return response() -> json (["Message", "Could not find Category"]);
        }
    }
    public function getAllCategories(){
        $category = Category::all();
        if($category){
            return response() -> json($category);
        }else {
            return response() -> json(["Message" => "Not found"]);
        }
    }
    public function createCategory(Request $request){
        $category = new Category;
        $category->name = $request->name;
        $category->save();
        return response() -> json(["message" => "Category has been added."]);
    }
    public function updateCategory(Request $request, $id){
        if(Category::where('id', $id) -> exists()){
            $category = Category::find($id);
            $category->name = is_null($request->name) ? $category->name : $request -> name;
            $category->save();
            return response() -> json(["Message" => "Category has been updated."]);
        }
            return response() -> json(["Message" => "Could not find category with the id" + $id ]);
        
    }
    public function deleteCategory($id){
        if(Category::where('id', $id) -> exists()){
            $category = Category::findOrFail($id);
            $category->delete();
            return response() -> json(["Message" => "The Category has been succesfully deleted."]);
        } 

        return response() -> json(["Message" => "The Category either does not exist or already deleted."]);
        
    }
}
