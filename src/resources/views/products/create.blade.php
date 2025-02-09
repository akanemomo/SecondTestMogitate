@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
@php
    // old() のデフォルト値を空配列にすることで、エラー防止
    $oldSeasons = old('season', []);
@endphp

<div class="container">
    <h2 class="title">商品登録</h2>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- 商品名 -->
        <label for="name">商品名 <span class="required">必須</span></label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="商品名を入力">
        @error('name')
            <p class="error">{{ $message }}</p>
        @enderror

        <!-- 値段 -->
        <label for="price">値段 <span class="required">必須</span></label>
        <input type="number" name="price" id="price" value="{{ old('price') }}" placeholder="値段を入力">
        @error('price')
            <p class="error">{{ $message }}</p>
        @enderror

        <!-- 商品画像 -->
        <label for="image">商品画像 <span class="required">必須</span></label>
        <input type="file" name="image" id="image">
        @error('image')
            <p class="error">{{ $message }}</p>
        @enderror

        <!-- 季節（複数選択可） -->
        <label>季節 <span class="required">必須</span> <span class="note">複数選択可</span></label>
        <div class="checkbox-group">
            @foreach (['春', '夏', '秋', '冬'] as $season)
                <label>
                    <input type="checkbox" name="season[]" value="{{ $season }}"
                        {{ in_array($season, $oldSeasons) ? 'checked' : '' }}>
                    {{ $season }}
                </label>
            @endforeach
        </div>
        @error('season')
            <p class="error">{{ $message }}</p>
        @enderror

        <!-- 商品説明 -->
        <label for="description">商品説明 <span class="required">必須</span></label>
        <textarea name="description" id="description" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
        @error('description')
            <p class="error">{{ $message }}</p>
        @enderror

        <!-- ボタン -->
        <div class="button-group">
            <a href="{{ route('products.index') }}" class="btn btn-gray">戻る</a>
            <button type="submit" class="btn btn-yellow">登録</button>
        </div>
    </form>
</div>
@endsection
