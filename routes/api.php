<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\CategoryApiController;
use App\Http\Controllers\ProductApiController;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//For Category CRUD
Route::get('viewCategory/{id}', [CategoryApiController::class, 'getCategory']);
Route::get('viewAllCategories', [CategoryApiController::class, 'getAllCategories']);
Route::post('createCategory', [CategoryApiController::class, 'createCategory']);
Route::post('updateCategory/{id}', [CategoryApiController::class, 'updateCategory']);
Route::post('deleteCategory/{id}', [CategoryApiController::class, 'deleteCategory']);

//For Product CRUD
Route::get('viewProduct/{id}', [ProductApiController::class, 'getProduct']);
Route::get('viewAllProducts', [ProductApiController::class, 'getAllProducts']);
Route::post('createProduct', [ProductApiController::class, 'createProduct']);
Route::post('updateProduct/{id}', [ProductApiController::class, 'updateProduct']);
Route::post('deleteProduct', [ProductApiController::class, 'deleteProduct']);