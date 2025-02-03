<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * 商品一覧画面の表示
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Product::query();
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $products = $query->paginate(6);

        return view('products.index', compact('products', 'search'));
    }

    /**
     * 商品登録画面の表示
     */
    public function create()
    {
        $seasons = Season::all();
        return view('products.create', compact('seasons'));
    }

    /**
     * 商品の保存
     */
    public function store(StoreProductRequest $request)
    {
        $imagePath = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('fruits-img', 'public');
            $imagePath = 'fruits-img/' . basename($path);
        }

        try {
            $product = Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'image' => $imagePath,
                'description' => $request->description,
            ]);

            if ($request->has('seasons')) {
                $product->seasons()->attach($request->seasons);
            }

            return redirect('/products')->with('success', '商品が追加されました！');
        } catch (\Exception $e) {
            return redirect('/products')->with('error', '商品登録に失敗しました。エラー: ' . $e->getMessage());
        }
    }

    /**
     * 商品詳細画面の表示
     */
    public function show(Product $product)
    {
        $seasons = Season::all();
        return view('products.show', compact('product', 'seasons'));
    }

    /**
     * 商品編集画面の表示
     */
    public function edit(Product $product)
    {
        $seasons = Season::all();
        return view('products.edit', compact('product', 'seasons'));
    }

    /**
     * 商品の更新
     */
    public function update(StoreProductRequest $request, Product $product)
    {
        try {
            \Log::info('🔵 商品更新開始', ['product_id' => $product->id]);

            // 画像の処理
            if ($request->hasFile('image')) {
                if ($product->image) {
                    Storage::disk('public')->delete($product->image);
                }
                $path = $request->file('image')->store('fruits-img', 'public');
                $imagePath = 'fruits-img/' . basename($path);
            } else {
                $imagePath = $product->image; // 画像が変更されていなければ元の画像を保持
            }

            // 商品情報を更新
            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'image' => $imagePath,
                'description' => $request->description,
            ]);

            // 季節データを更新
            if ($request->has('seasons')) {
                $product->seasons()->sync($request->seasons);
            } else {
                $product->seasons()->detach();
            }

            \Log::info('🟢 商品更新成功', ['product_id' => $product->id]);

            return redirect('/products')->with('success', '商品が更新されました！');
        } catch (\Exception $e) {
            \Log::error('🔴 商品更新エラー', ['error' => $e->getMessage()]);
            return back()->with('error', '商品更新に失敗しました。エラー: ' . $e->getMessage());
        }
    }

    /**
     * 商品の削除
     */
    public function destroy(Product $product)
    {
        try {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $product->delete();

            return redirect('/products')->with('success', '商品が削除されました！');
        } catch (\Exception $e) {
            return redirect('/products')->with('error', '商品削除に失敗しました。エラー: ' . $e->getMessage());
        }
    }
}

