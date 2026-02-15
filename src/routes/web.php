<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products',[ProductController::class,'index']);
Route::get('/products/search', [ProductController::class, 'search']);
Route::get('/products/detail/{product}', [ProductController::class, 'edit'])->name('products.edit');
Route::post('/products/{product}/update', [ProductController::class, 'update'])->name('products.update');
Route::post('/products/{product}/delete', [ProductController::class, 'destroy'])->name('products.delete');
Route::get('/products/register',[ProductController::class,'register']);
Route::post('/products/register',[ProductController::class,'create'])->name('products.store');