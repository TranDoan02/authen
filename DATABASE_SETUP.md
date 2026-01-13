# Cấu Hình Database MySQL

## Đã cập nhật

✅ Đã chuyển từ SQLite sang MySQL trong:
- `.env` - DB_CONNECTION=mysql
- `.env.example` - DB_CONNECTION=mysql
- `config/database.php` - default connection = mysql

## Cấu hình hiện tại

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=antranauthentic
DB_USERNAME=root
DB_PASSWORD=
```

## Bước tiếp theo

1. **Tạo database MySQL:**
   ```sql
   CREATE DATABASE antranauthentic CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

   Hoặc dùng phpMyAdmin/Laragon để tạo database.

2. **Chạy migrations:**
   ```bash
   php artisan migrate
   ```

3. **(Optional) Xóa file SQLite cũ:**
   Nếu không cần dữ liệu SQLite cũ, có thể xóa:
   ```bash
   rm database/database.sqlite
   ```

## Lưu ý

- Đảm bảo MySQL service đang chạy
- Kiểm tra username/password trong `.env` phù hợp với MySQL của bạn
- Database name có thể thay đổi trong `.env` nếu cần

