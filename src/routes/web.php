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

// 商品のリソースルート（indexは既に設定済みのため除外）
Route::resource('products', ProductController::class)->except(['index']);
