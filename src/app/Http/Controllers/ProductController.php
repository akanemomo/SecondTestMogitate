<?php

namespace App\Http\Controllers;

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
        // 検索キーワードの取得
        $search = $request->input('search');

        // クエリビルダの開始
        $query = Product::query();

        if ($search) {
            // 商品名で部分一致検索
            $query->where('name', 'like', '%' . $search . '%');
        }

        // ページネーション（6件ずつ）
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
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
            'seasons' => 'nullable|array',
            'seasons.*' => 'exists:seasons,id',
        ]);

        // 画像のアップロード
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // 商品の作成
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $imagePath,
            'description' => $request->description,
        ]);

        // 季節との関連付け
        if ($request->has('seasons')) {
            $product->seasons()->attach($request->seasons);
        }

        return redirect()->route('products.index')->with('success', '商品が追加されました。');
    }

    /**
     * 商品詳細画面の表示
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
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
    public function update(Request $request, Product $product)
    {
        // バリデーション
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
            'seasons' => 'nullable|array',
            'seasons.*' => 'exists:seasons,id',
        ]);

        // 画像のアップロード（必要な場合）
        if ($request->hasFile('image')) {
            // 既存の画像を削除
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        // 商品情報の更新
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        // 季節との関連付け
        if ($request->has('seasons')) {
            $product->seasons()->sync($request->seasons);
        } else {
            $product->seasons()->detach();
        }

        return redirect()->route('products.index')->with('success', '商品が更新されました。');
    }

    /**
     * 商品の削除
     */
    public function destroy(Product $product)
    {
        // 画像の削除
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        // 商品の削除
        $product->delete();

        return redirect()->route('products.index')->with('success', '商品が削除されました。');
    }
}
