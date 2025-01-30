<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            // idカラム: bigint unsigned + PRIMARY KEY
            // Laravelの $table->bigIncrements() は自動で符号なしPKを作ります。
            $table->bigIncrements('id');

            $table->string('name', 255);      // 商品名 (NOT NULL)
            $table->integer('price');         // 商品料金 (NOT NULL)
            $table->string('image', 255);     // 商品画像 (NOT NULL)
            $table->text('description');      // 商品説明 (NOT NULL)

            // created_at, updated_at を自動生成
            $table->timestamps();
        });
    }

    public function down()
    {
        // ロールバック用: テーブルを消す
        Schema::dropIfExists('products');
    }
}