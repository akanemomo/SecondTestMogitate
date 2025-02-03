@extends('layouts.app')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('css/show.css') }}?v={{ time() }}">
</head>

<div class="container">
    <header class="header">
        <h1 class="logo">mogitate</h1>
    </header>

    <!-- パンくずリスト -->
    <nav class="breadcrumb">
        <a href="{{ route('products.index') }}">商品一覧</a> &gt; <span>{{ $product->name }}</span>
    </nav>

    <main class="product-detail">
        <div class="detail-container">
            <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="image-info-wrapper">
                    <!-- 画像エリア（左側） -->
                    <div class="image-container">
                        @if(!empty($product->image))
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image">
                        @else
                            <p>画像がありません</p>
                        @endif
                        <input type="file" name="image" class="file-input">
                        @error('image') <p class="error-text">{{ $message }}</p> @enderror
                    </div>

                    <!-- 商品情報エリア（右側） -->
                    <div class="info-container">
                        <div class="info-item">
                            <label for="name">商品名</label>
                            <input type="text" name="name" id="name" class="input-field" value="{{ old('name', $product->name) }}">
                            @error('name') <p class="error-text">{{ $message }}</p> @enderror
                        </div>

                        <div class="info-item">
                            <label for="price">値段</label>
                            <input type="number" name="price" id="price" class="input-field" value="{{ old('price', $product->price) }}">
                            @error('price') <p class="error-text">{{ $message }}</p> @enderror
                        </div>

                        <div class="info-item">
                            <label>季節</label>
                            <div class="season-checkboxes">
                                @foreach($seasons as $season)
                                    <label for="season_{{ $season->id }}">
                                        <input type="checkbox" name="seasons[]" id="season_{{ $season->id }}" value="{{ $season->id }}"
                                        {{ in_array($season->id, old('seasons', $product->seasons->pluck('id')->toArray())) ? 'checked' : '' }}>
                                        {{ $season->name }}
                                    </label>
                                @endforeach
                            </div>
                            @error('seasons') <p class="error-text">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <!-- 商品説明（画像の下に配置） -->
                <div class="info-item description-container">
                    <label for="description">商品説明</label>
                    <textarea name="description" id="description" class="textarea-field">{{ old('description', $product->description) }}</textarea>
                    @error('description') <p class="error-text">{{ $message }}</p> @enderror
                </div>

                <!-- ボタン -->
                <div class="button-group">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">戻る</a>
                    <button type="submit" class="btn btn-warning">変更を保存</button>
                </div>
            </form>

            <form method="POST" action="{{ route('products.destroy', $product->id) }}" class="delete-form">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-button" onclick="return confirm('本当に削除しますか？');">🗑️</button>
            </form>
        </div>
    </main>
</div>
@endsection

