<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products'; // Laravel 8以降は慣例通りなら自動認識
    // もしfillableなど指定したい場合
    protected $fillable = ['name', 'price', 'image', 'description'];

    // 多対多リレーション
    public function seasons()
    {
        return $this->belongsToMany(Season::class, 'product_season', 'product_id', 'season_id');
    }
}
