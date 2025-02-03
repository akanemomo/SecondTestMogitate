<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SecondTestMogitate</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* プレースホルダーのスタイル */
        .placeholder-text::placeholder {
            color: gray;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">  {{-- ここを変更 --}}
    @yield('css')  {{-- 各ページごとのCSSを追加できる --}}
</head>
<body>
    <!-- ナビゲーションバー -->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #F5C800; padding: 15px;">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('products.index') }}" style="font-family: 'jsMath-cmti10'; font-size: 30px; font-style: italic; font-weight: 500; color: #333;">
                mogitate
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index') }}" style="color: #333; font-weight: 500;">ホーム</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index') }}" style="color: #333; font-weight: 500;">商品一覧</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}" style="color: #333; font-weight: 500;">お問い合わせ</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- メインコンテンツ -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- フッター -->
    <footer class="bg-light text-center text-lg-start mt-5" style="padding: 15px;">
        <div class="text-center p-3" style="color: #333; font-weight: 500;">
            © {{ date('Y') }} SecondTestMogitate. All rights reserved.
        </div>
    </footer>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>