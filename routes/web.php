<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

// Route::get('/', function () {
//     return view('welcome');
// });

//admin side routes

Route::get('/food_add',[AdminController::class,'food_add']);

Route::post('/upload_food',[AdminController::class,'upload_food']);

Route::get('/food_view',[AdminController::class,'food_view']);

Route::get('/delete_food/{id}',[AdminController::class,'delete_food']);

Route::get('/update_food/{id}',[AdminController::class,'update_food']);

Route::post('/edit_food/{id}',[AdminController::class,'edit_food']);

Route::get('/food_orders',[AdminController::class,'food_orders']);

Route::get('/on_the_way/{id}',[AdminController::class,'on_the_way']);

Route::get('/delivered/{id}',[AdminController::class,'delivered']);

Route::get('/cancel/{id}',[AdminController::class,'cancel']);

Route::get('/book_table_list',[AdminController::class,'book_table_list']);



//user side routes

Route::get('/',[HomeController::class,'my_home']);
Route::get('/home',[HomeController::class,'index']);

Route::post('/cart_add/{id}',[HomeController::class,'cart_add']);

Route::get('/my_cart',[HomeController::class,'my_cart']);

Route::get('/delete_cart/{id}',[HomeController::class,'delete_cart']);

Route::post('/order_confirm',[HomeController::class,'order_confirm']);

Route::post('/book_table',[HomeController::class,'book_table']);





Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
