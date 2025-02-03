@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}"> {{-- create.css に変更 --}}
@endsection

@section('content')
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
            <label><input type="checkbox" name="season[]" value="春"> 春</label>
            <label><input type="checkbox" name="season[]" value="夏"> 夏</label>
            <label><input type="checkbox" name="season[]" value="秋"> 秋</label>
            <label><input type="checkbox" name="season[]" value="冬"> 冬</label>
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
