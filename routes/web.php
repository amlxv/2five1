<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\MyShopController;
use App\Http\Controllers\BecomeSellerController;
use App\Http\Controllers\MarketplaceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::redirect('/', 'marketplace', 301);

Route::resource('marketplace', MarketplaceController::class);

Route::get('/items/{id}/buy', [MarketplaceController::class, 'buy'])->middleware('auth')->name('buy.show');

Route::middleware(['auth'])->group(function () {
    Route::resources([
        'profile' => ProfileController::class,
        'become-seller' => BecomeSellerController::class,
        'shop' => MyShopController::class,
        'products' => ProductController::class,
    ]);
});