<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            ['name' => 'キウイ', 'price' => 800, 'description' => 'キウイは甘みと酸味のバランスが絶妙なフルーツです。...', 'seasons' => ['秋', '冬']],
            ['name' => 'ストロベリー', 'price' => 1200, 'description' => '大人から子供まで大人気のストロベリー。...', 'seasons' => ['春']],
            ['name' => 'オレンジ', 'price' => 850, 'description' => '当店では酸味と甘みのバランスが抜群のネーブルオレンジを使用...', 'seasons' => ['冬']],
            ['name' => 'スイカ', 'price' => 700, 'description' => '甘くてシャリシャリ食感が魅力のスイカ。...', 'seasons' => ['夏']],
            ['name' => 'ピーチ', 'price' => 1000, 'description' => '豊潤な香りととろけるような甘さが魅力のピーチ。...', 'seasons' => ['夏']],
            ['name' => 'シャインマスカット', 'price' => 1400, 'description' => '爽やかな香りと上品な甘みが特長的なシャインマスカット...', 'seasons' => ['夏', '秋']],
            ['name' => 'パイナップル', 'price' => 800, 'description' => '甘酸っぱさとトロピカルな香りが特徴のパイナップル...', 'seasons' => ['春', '夏']],
            ['name' => 'ブドウ', 'price' => 1100, 'description' => 'ブドウの中でも人気の高い国産の「巨峰」を使用...', 'seasons' => ['夏', '秋']],
            ['name' => 'バナナ', 'price' => 600, 'description' => '低カロリーでありながら栄養満点のため、ダイエット中の方にもおすすめ...', 'seasons' => ['夏']],
            ['name' => 'メロン', 'price' => 900, 'description' => '香りがよくジューシーで品のある甘さが人気のメロンスムージー...', 'seasons' => ['春', '夏']],
        ];

        foreach ($products as $product) {
            // 商品データを挿入
            $productId = DB::table('products')->insertGetId([
                'name' => $product['name'],
                'price' => $product['price'],
                'description' => $product['description'],
                'image' => 'fruits-img/' . strtolower($product['name']) . '.jpg', // 仮の画像パス
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // 季節の紐付け（中間テーブルへの登録）
            foreach ($product['seasons'] as $seasonName) {
                $season = DB::table('seasons')->where('name', $seasonName)->first();
                if ($season) {
                    DB::table('product_season')->insert([
                        'product_id' => $productId,
                        'season_id' => $season->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
