

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\ProdukController;
use App\Http\Controllers\Api\WishlistController;
use App\Http\Controllers\Api\CartController; // Perbaikan 2: Mengimpor CartController
use App\Http\Controllers\Api\PromoController;
use App\Http\Controllers\Api\UserProfileController;
use App\Http\Controllers\Api\TransaksiController;
use App\Http\Controllers\Api\Detailcontroller;
use App\Http\Controllers\Api\PesananController;
use App\Http\Controllers\Api\BannerController;


use App\Models\Pembeli;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/Pembeli', function (Request $request) {
    return $request->pembeli();
});

Route::post("register", [ApiController::class, "register"]);
Route::post("login", [ApiController::class, "login"]);

Route::group([
    "middleware" => ["auth:api"]
], function(){
    // Route::get("profile", [ApiController::class, "fetch"]);
    Route::get("refresh", [ApiController::class, "refreshToken"]);
    Route::get("logout", [ApiController::class, "logout"]);
});

Route::get("/get", [ProdukController::class, "fetch"]);
Route::get("profile", [UserProfileController::class, "profile"]);
Route::post('/produk', [ProdukController::class, "store"]);
Route::post('produk/search/', [ProdukController::class, "search"]);
Route::put('produk/{id}', [ProdukController::class, "update"]);
Route::get('produk', [ProdukController::class, "index"]);
Route::get('produkkat/', [ProdukController::class, "getByCategory"]);
Route::get('produk/{id}', [ProdukController::class, "show"]);

Route::get('wishlist', [WishlistController::class, "index"]);
Route::get('wishlist/{id}', [WishlistController::class, "show"]);
Route::get('banner', [BannerController::class, "index"]);
Route::get('wishlist/{id}', [WishlistController::class, "show"]);

Route::post('wishlist', [WishlistController::class, "store"]);
Route::delete('wishlist/{id}', [WishlistController::class, "destroy"]);

Route::get('kategori', [ProdukController::class, "kategori"]);
Route::post('pesanan', [PesananController::class, "store"]);
Route::get('pesanan', [PesananController::class, "index"]);

Route::get("/get", [ProdukController::class, "fetch"]);

Route::get("/get", [CartController::class, "fetch"]);
Route::post('cart', [CartController::class, "store"]); // Perbaikan 4: Menggunakan CartController
Route::delete('cart/{id}', [CartController::class, "destroy"]); // Perbaikan 4: Menggunakan CartController
Route::put('cart/{id}', [CartController::class, "update"]); // Jika ada endpoint update
Route::get('cart', [CartController::class, "index"]);

// Route::get('user', [UserProfileController::class, "index"]);
Route::post('user', [UserProfileController::class, "update"]);



Route::get("/get", [TransaksiController::class, "fetch"]);
Route::post('transaksi', [TransaksiController::class, "store"]);
Route::put('transaksi/{id}', [TransaksiController::class, "update"]);
Route::get('transaksi',[TransaksiController::class, "index"]);




Route::get("/get", [PromoController::class, "fetch"]);
Route::post('promo', [PromoController::class, "store"]);
Route::put('promo/{id}', [PromoController::class, "update"]);
Route::get('promo',[PromoController::class, "index"]);
