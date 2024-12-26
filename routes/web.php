<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(
    ['prefix' => '{locale}', 'middleware' => 'locale'],
    function () {


        Route::get('/', [ProductController::class, 'index'])->name('products.index');

        Route::controller(CartController::class)->name('cart.')->group(function () {
            Route::get('/cart', [CartController::class, 'index'])->name('index');
            Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('add');
            Route::patch('/cart/update/{cart}', [CartController::class, 'update'])->name('update');
            Route::delete('/cart/remove/{cart}', [CartController::class, 'remove'])->name('remove');
        });
    }
);
