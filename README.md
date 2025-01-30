# SecondTestMogitate(確認テスト\_もぎたて)

## 環境構築

以下の手順に従って、開発環境をセットアップしてください。

1. **リポジトリのクローン**

    ```bash
    git clone git@github.com:akanemomo/SecondTestMogitate.git
    cd SecondTestMogitate
    ```

2. **Docker コンテナのビルドと起動**

    Docker がインストールされていることを確認してください。

    ```bash
    docker-compose up -d --build
    ```

3. **Composer のインストール**

    ```bash
    docker-compose exec app composer install
    ```

4. **環境設定ファイルの作成**

    `.env.example` をコピーして `.env` ファイルを作成します。

    ```bash
    cp .env.example .env
    ```

5. **アプリケーションキーの生成**

    ```bash
    docker-compose exec app php artisan key:generate
    ```

6. **データベースマイグレーションの実行**

    ```bash
    docker-compose exec app php artisan migrate
    ```

7. **シーディング**

    ダミーデータを投入する場合は、以下のコマンドを実行します。

    ```bash
    docker-compose exec app php artisan db:seed
    ```

## 使用技術(実行環境)

-   **言語**: PHP 8.x
-   **フレームワーク**: Laravel 9.x
-   **データベース**: MySQL
-   **コンテナ化**: Docker, Docker Compose
-   **フロントエンド**: Blade テンプレート, CSS
    mysql:
    platform: linux/x86_64(この文追加)
    image: mysql:8.0.26
    environment:

````

**Laravel環境構築**
1. `docker-compose exec php bash`
2. `composer install`
3. 「.env.example」ファイルを 「.env」ファイルに命名を変更。または、新しく.envファイルを作成
4. .envに以下の環境変数を追加
``` text
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
````

5. アプリケーションキーの作成

```bash
php artisan key:generate
```

6. マイグレーションの実行

```bash
php artisan migrate
```

7. シーディングの実行

```bash
php artisan db:seed
```

## 使用技術(実行環境)

-   **言語**: PHP 8.x
-   **フレームワーク**: Laravel 9.x
-   **データベース**: MySQL
-   **コンテナ化**: Docker, Docker Compose
-   **フロントエンド**: Blade テンプレート, CSS

## ER 図

![ER図](src/resources/doc/er-diagram.png)

## URL

-   **開発環境**: [http://localhost:8000](http://localhost:8000)
