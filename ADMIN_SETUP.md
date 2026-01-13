# Admin Panel Setup

## Đã tạo

### 1. Database
- ✅ Migration: `add_is_admin_to_users_table` - Thêm field `is_admin` vào users

### 2. Models
- ✅ User model: Thêm `is_admin` vào fillable và casts, method `isAdmin()`

### 3. Middleware
- ✅ `AdminMiddleware` - Kiểm tra user có phải admin không

### 4. Routes
- ✅ `routes/admin.php` - Tất cả admin routes với prefix `/admin` và middleware `auth`, `admin`
- ✅ Đăng ký trong `bootstrap/app.php`

### 5. Controllers
- ✅ `DashboardController` - Dashboard với stats, recent orders, top products
- ✅ `ProductController` - CRUD sản phẩm
- ✅ `CategoryController` - CRUD danh mục

### 6. Views
- ✅ `admin/layout.blade.php` - Layout admin với sidebar
- ✅ `admin/dashboard.blade.php` - Dashboard
- ✅ `admin/products/index.blade.php` - Danh sách sản phẩm
- ✅ `admin/products/create.blade.php` - Thêm sản phẩm
- ✅ `admin/products/edit.blade.php` - Sửa sản phẩm
- ✅ `admin/categories/index.blade.php` - Danh sách danh mục
- ✅ `admin/categories/create.blade.php` - Thêm danh mục
- ✅ `admin/categories/edit.blade.php` - Sửa danh mục

## Cần làm tiếp

### 1. Chạy Migration
```bash
php artisan migrate
```

### 2. Tạo Admin User
Có thể tạo bằng tinker hoặc seeder:
```php
php artisan tinker
User::create([
    'name' => 'Admin',
    'email' => 'admin@example.com',
    'password' => bcrypt('password'),
    'is_admin' => true,
]);
```

### 3. Các Controllers còn thiếu
- [ ] `OrderController` - Quản lý đơn hàng
- [ ] `PostController` - Quản lý bài viết
- [ ] `FlashSaleController` - Quản lý flash sale

### 4. Views còn thiếu
- [ ] `admin/products/show.blade.php` - Chi tiết sản phẩm
- [ ] `admin/categories/show.blade.php` - Chi tiết danh mục
- [ ] `admin/orders/index.blade.php` - Danh sách đơn hàng
- [ ] `admin/orders/show.blade.php` - Chi tiết đơn hàng
- [ ] `admin/posts/*` - CRUD bài viết
- [ ] `admin/flash-sales/*` - CRUD flash sale

## Truy cập Admin Panel

Sau khi tạo admin user và đăng nhập:
- URL: `/admin`
- Hoặc: `/admin/dashboard`

## Features

### Dashboard
- Tổng số sản phẩm, đơn hàng, doanh thu, users
- Đơn hàng gần đây
- Sản phẩm bán chạy

### Products Management
- Danh sách sản phẩm với search và filter
- Thêm/Sửa/Xóa sản phẩm
- Upload hình ảnh
- Quản lý giá, tồn kho, trạng thái

### Categories Management
- Danh sách danh mục (hierarchical)
- Thêm/Sửa/Xóa danh mục
- Quản lý danh mục cha/con
- Upload hình ảnh

