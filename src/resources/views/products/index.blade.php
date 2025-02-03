@extends('layouts.app')

@section('content')
    <div class="product-list-container">
        <h2 class="title">商品一覧</h2>

        <!-- 商品追加ボタン -->
        <a href="{{ route('products.create') }}" class="add-product">＋ 商品を追加</a>

        <!-- 検索フォーム -->
        <div class="search-container">
            <form action="{{ route('products.index') }}" method="GET" class="search-form">
                <input type="text" name="search" placeholder="商品名で検索" value="{{ request('search') }}">
                <button type="submit" class="search-button">検索</button>
            </form>
        </div>

        <!-- 商品一覧（3列グリッド） -->
        <div class="product-list">
            @foreach($products as $product)
                <!-- ✅ 商品カードをリンク化 -->
                <a href="{{ route('products.show', $product->id) }}" class="product-item">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image">
                    <p class="product-name">{{ $product->name }}</p>
                    <p class="product-price">¥{{ number_format($product->price) }}</p>
                </a>
            @endforeach
        </div>

        <!-- ページネーション -->
        <div class="pagination">
            {{ $products->links('pagination::default') }}
        </div>
    </div>
@endsection
