# SecondTestMogitate(確認テスト\_もぎたて)

## 環境構築

以下の手順に従って、開発環境をセットアップしてください。

### 1. リポジトリのクローン

```bash
git clone git@github.com:akanemomo/SecondTestMogitate.git
cd SecondTestMogitate
```

### 2. Docker コンテナのビルドと起動

Docker がインストールされていることを確認してください。

```bash
docker-compose up -d --build
```

### 3. Composer のインストール

```bash
docker-compose exec app composer install
```

### 4. 環境設定ファイルの作成

`.env.example` をコピーして `.env` ファイルを作成します。

```bash
cp .env.example .env
```

### 5. 環境変数(.env)

以下の環境変数を `.env` に記載してください。

```dotenv
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```

🚨 重要：作成した .env をコンテナにコピー

```bash
docker cp .env secondtestmogitate-php-1:/var/www/.env
```

### 6. ストレージとキャッシュディレクトリの権限設定

```bash
docker-compose exec app chmod -R 775 storage bootstrap/cache
docker-compose exec app chown -R www-data:www-data storage bootstrap/cache
```

### 7. 設定ファイルのキャッシュクリア

```bash
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:cache
```

### 8. アプリケーションキーの生成

```bash
docker-compose exec app php artisan key:generate
```

### 9. マイグレーションの実行

```bash
docker-compose exec app php artisan migrate
```

### 10. シーディング（ダミーデータ投入）

```bash
docker-compose exec app php artisan db:seed
```

### 11. 画像の表示設定

商品画像を正しく表示するために、シンボリックリンクを作成します。

```bash
docker-compose exec app php artisan storage:link
```

## 商品登録機能

- 商品名、価格、画像、季節（複数選択可）、説明を登録可能
- 画像は `storage/app/public/fruits-img/` に保存
- 季節は `seasons` テーブルにリレーションとして保存
- 登録後は `/products` にリダイレクト

## エラー対応

クローン後に以下のエラーが発生した場合の対処法を記載します。

❌ Please provide a valid cache path. エラー

原因: storage/framework/cache ディレクトリが作成されていない、または権限不足のため発生

解決策:

```bash
docker-compose exec app mkdir -p storage/framework/cache/data
docker-compose exec app chmod -R 775 storage bootstrap/cache
docker-compose exec app chown -R www-data:www-data storage bootstrap/cache
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan key:generate
```

コンテナを再起動した後に .env が消えた場合

```bash
docker cp .env secondtestmogitate-php-1:/var/www/.env
```

→ .env を再度コピーし、config:clear などを実行し直す。

## 使用技術(実行環境)

- **言語**: PHP 8.x
- **フレームワーク**: Laravel 9.x
- **データベース**: MySQL
- **コンテナ化**: Docker, Docker Compose
- **フロントエンド**: Blade テンプレート, CSS

## MySQL 設定 (docker-compose.yml)

```yaml
mysql:
  platform: linux/x86_64
  image: mysql:8.0.26
  environment:
    MYSQL_ROOT_PASSWORD: root
    MYSQL_DATABASE: laravel_db
    MYSQL_USER: laravel_user
    MYSQL_PASSWORD: laravel_pass
```

## ER 図

![ER図](./src/resources/doc/er-diagram.png)

## URL

- **開発環境**: [http://localhost:8000](http://localhost:8000)
