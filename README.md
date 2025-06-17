## アプリケーション名

ここにアプリの名前を記載

## 環境構築

1. Docker の設定
   下記コマンドを実行
   <br>
   `docker-compose up -d --build`

2. Laravel のインストール
   下記コマンドを実行
   <br>
   `docker-compose exec php bash`
   `composer install`

3. .env ファイルの作成
   下記コマンドを実行
   <br>
   `cp .env.example .env`
   <br>
   `exit`
   <br>
   VSCode で.env ファイル 11 行目以降を下記に修正
   <br>
   .env ファイル
   <br>
   `DB_CONNECTION=mysql`
   <br>
   `DB_HOST=mysql`
   <br>
   `DB_PORT=3306`
   <br>
   `DB_DATABASE=laravel_db`
   <br>
   `DB_USERNAME=[ユーザー名]`
   `DB_PASSWORD=[パスワード]`

## ER 図

![ER図](ER.drawio.png)
