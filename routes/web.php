<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;


//login / register

Route::middleware('admin_auth')->group(function(){
    Route::redirect('/', 'loginPage');
    Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
    Route::get('registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');

});



// authentication  group

Route::middleware(['auth'])->group(function () {

    //dashboard
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');

   //admin
   Route::group(['middleware'=>'admin_auth'], function(){
    //category
    Route::prefix('category')->group(function(){
    Route::get('list',[CategoryController::class,'list'])->name('category#list');
    Route::get('create/page',[CategoryController::class,'createPage'])->name('category#createPage');
    Route::post('create',[CategoryController::class,'create'])->name('category#create');
    Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
    Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
    Route::post('update',[CategoryController::class,'update'])->name('category#update');

   });

   //admin account
   Route::prefix('admin')->group(function(){
    //password
    Route::get('password/changePage',[AdminController::class,'changePasswordPage'])->name('admin#changePasswordPage');
    Route::post('change/password',[AdminController::class,'changePassword'])->name('admin#changePassword');

    //profile
    Route::get('details',[AdminController::class,'details'])->name('admin#details');
    Route::get('edit',[AdminController::class, 'edit'])->name('admin#edit');
    Route::post('update/{id}',[AdminController::class,'update'])->name('admin#update');

    //admin list
    Route::get('list',[AdminController::class,'list'])->name('admin#list');
    Route::get('delete/{id}',[AdminController::class,'delete'])->name('admin#delete');
    Route::get('changeRole/{id}',[AdminController::class,'changeRole'])->name('admin#changeRole');
    Route::post('change/role/{id}',[AdminController::class,'change'])->name('admin#change');


   });

   //product
   Route::prefix('products')->group(function(){
    Route::get('list',[ProductController::class,'list'])->name('products#list');
    Route::get('createPage',[ProductController::class,'createPage'])->name('products#createPage');
    Route::post('create',[ProductController::class,'create'])->name('products#create');
    Route::get('delete/{id}',[ProductController::class,'delete'])->name('products#delete');
    Route::get('edit/{id}',[ProductController::class,'edit'])->name('products#edit');
    Route::get('updatePage/{id}',[ProductController::class,'updatePage'])->name('products#updatePage');
    Route::post('update',[ProductController::class,'update'])->name('products#update');
   });

   //user
   Route::prefix('user')->group(function(){
    Route::get('list',[UserController::class,'userlist'])->name('admin#userList');
    Route::get('change/user/role',[UserController::class,'userChangeRole'])->name('admin#userChangeRole');
    Route::get('message/list',[UserController::class,'userMessageList'])->name('admin#userMessageList');
    Route::get('delete/{id}',[UserController::class,'deleteUser'])->name('admin#deleteUser');
    Route::get('edit/{id}',[UserController::class,'editUser'])->name('admin#editUser');
    Route::post('update/{id}',[UserController::class,'updateUser'])->name('admin#updateUser');

   });

   //order
   Route::prefix('order')->group(function(){
    Route::get('list',[OrderController::class, 'orderList'])->name('admin#orderList');
    Route::get('change/status',[OrderController::class,'changeStatus'])->name('admin#changeStatus');
    Route::get('ajax/change/status',[OrderController::class,'ajaxChangeStatus'])->name('admin#ajaxChangeStatus');
    Route::get('listInfo/{orderCode}',[OrderController::class,'listInfo'])->name('admin#listInfo');


   });


});

    //User
    //home
Route::group(['prefix'=>'user','middleware'=>'user_auth'], function(){
    Route::get('home',[UserController::class,'home'])->name('user#home');
    Route::get('filter/{id}',[UserController::class,'filter'])->name('user#filter');
    Route::get('history',[UserController::class,'history'])->name('user#history');
    Route::get('contact',[UserController::class,'contact'])->name('user#contact');

    // pizza
    Route::prefix('pizza')->group(function(){
        Route::get('details/{id}',[UserController::class,'pizzaDetails'])->name('user#pizzaDetails');
    });

    //cart
    Route::prefix('cart')->group(function(){
        Route::get('cartList',[UserController::class,'cartList'])->name('user#cartList');
    });


    //password
    Route::prefix('password')->group(function(){
        Route::get('changePage',[UserController::class,'changePasswordPage'])->name('user#changePasswordPage');
        Route::post('change',[UserController::class,'changePassword'])->name('user#changePassword');
    });

    //profile
    Route::prefix('account')->group(function(){
        Route::get('accountChangePage',[UserController::class,'accountChangePage'])->name('user#accountChangePage');
        Route::post('accountChange/{id}',[UserController::class,'accountChange'])->name('user#accountChange');

    });

    // contact
    Route::prefix('contact')->group(function(){
        Route::post('contact/message', [ContactController::class, 'userMessage'])->name('user#message');
    });

    //ajax
    Route::prefix('ajax')->group(function(){
        Route::get('pizzaList',[AjaxController::class,'pizzaList'])->name('ajax#pizzaList');
        Route::get('addToCart',[AjaxController::class,'addToCart'])->name('ajax#addToCart');
        Route::get('order',[AjaxController::class,'order'])->name('ajax#order');
        Route::get('clear/cart',[AjaxController::class,'clearCart'])->name('ajax#clearCart');
        Route::get('clear/current/product',[AjaxController::class,'clearCurrentProduct'])->name('clearCurrentProduct');
        Route::get('increase/viewCount', [AjaxController::class, 'increaseViewCount'])->name('ajax#increaseViewCount');
    });
});

});



