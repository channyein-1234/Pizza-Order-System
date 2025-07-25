<?php

use App\Http\Controllers\API\RouteController;
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


Route::get('product/list',[RouteController::class,'productList']);
Route::get('category/list',[RouteController::class,'categoryList']);

 //post
 Route::post('create/category',[RouteController::class,'createCategory']);
 Route::post('create/contact',[RouteController::class,'createContact']);
 Route::post('delete/category',[RouteController::class,'deleteCategory']);
 Route::post('details/category',[RouteController::class,'categoryDetails']);
 Route::post('update/category', [RouteController::class,'updateCategory']);


 // in post man
//  localhost:8000/api/product/list  (get method)
 //localhost:8000/api/create/category (post method) ***api
