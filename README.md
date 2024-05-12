## Setup project
### 1. Chuẩn bị môi trường

- Nếu dùng Windows: Cài [xampp](https://www.apachefriends.org/download.html) _(Lưu ý chọn phiên bản PHP 8.1)_
- Nếu dùng Mac hoặc Linux: Cài riêng lẻ các thành phần sau:
  - PHP 8.1
  - nginx _(hoặc apache)_
  - MySql
- Trên MySql vừa cài, tạo 1 DB mới với tên là `blog-game`, collation `utf8mb4_general_ci`
- Cài Composer 2

### 2. Setup
- Setup file `.env`:
  - Copy `.env.example` to `.env`
  - Edit file `.env` set `DB_DATABASE=blog-game`
- Mở terminal, `cd` đến project và chạy các commands:
    - `composer install`
    - `php artisan key:generate`
    - `php artisan migrate`
    - `php artisan db:seed`
    - `npm install` && `npm run dev`
- Config virtual host _(optional)_
