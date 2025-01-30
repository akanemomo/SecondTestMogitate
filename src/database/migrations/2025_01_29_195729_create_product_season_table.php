<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSeasonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_season', function (Blueprint $table) {
        $table->bigIncrements('id');              // PRIMARY KEY
        $table->unsignedBigInteger('product_id'); // FOREIGN KEY (products.id)
        $table->unsignedBigInteger('season_id');  // FOREIGN KEY (seasons.id)
        $table->timestamps();

        // 外部キー制約
        // onDelete('cascade') -> 関連レコード削除時にこちらも削除するかどうかを指定
        $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        $table->foreign('season_id')->references('id')->on('seasons')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_season');
    }
}
