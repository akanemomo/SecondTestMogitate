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

// ホームページを商品一覧画面に設定
Route::get('/', [ProductController::class, 'index'])->name('products.index');

// 商品一覧ページのルート
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// 商品のリソースルートをフルセットで定義（index も含む）
Route::resource('products', ProductController::class);

// お問い合わせページのルート
Route::get('/contact', function () {
    return view('contact'); // 必要なら変更
})->name('contact');