<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Sản phẩm làm đẹp
        $lamDep = Category::create([
            'name' => 'Sản phẩm làm đẹp',
            'slug' => 'san-pham-lam-dep',
            'description' => 'Các sản phẩm chăm sóc và làm đẹp da, tóc, cơ thể',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        Category::create([
            'name' => 'Làm đẹp da',
            'slug' => 'lam-dep-da',
            'parent_id' => $lamDep->id,
            'is_active' => true,
            'sort_order' => 1,
        ]);

        Category::create([
            'name' => 'Hỗ trợ tóc',
            'slug' => 'ho-tro-toc',
            'parent_id' => $lamDep->id,
            'is_active' => true,
            'sort_order' => 2,
        ]);

        Category::create([
            'name' => 'Kích cỡ ngực',
            'slug' => 'kich-co-nguc',
            'parent_id' => $lamDep->id,
            'is_active' => true,
            'sort_order' => 3,
        ]);

        Category::create([
            'name' => 'Vệ sinh cá nhân',
            'slug' => 've-sinh-ca-nhan',
            'parent_id' => $lamDep->id,
            'is_active' => true,
            'sort_order' => 4,
        ]);

        // Sản phẩm sức khỏe
        $sucKhoe = Category::create([
            'name' => 'Sản phẩm sức khỏe',
            'slug' => 'san-pham-suc-khoe',
            'description' => 'Các sản phẩm hỗ trợ và bảo vệ sức khỏe',
            'is_active' => true,
            'sort_order' => 2,
        ]);

        Category::create([
            'name' => 'Hỗ trợ chống lão hóa',
            'slug' => 'ho-tro-chong-lao-hoa',
            'parent_id' => $sucKhoe->id,
            'is_active' => true,
            'sort_order' => 1,
        ]);

        Category::create([
            'name' => 'Sức khoẻ nam giới',
            'slug' => 'suc-khoe-nam-gioi',
            'parent_id' => $sucKhoe->id,
            'is_active' => true,
            'sort_order' => 2,
        ]);

        Category::create([
            'name' => 'Sức khỏe phụ nữ',
            'slug' => 'suc-khoe-phu-nu',
            'parent_id' => $sucKhoe->id,
            'is_active' => true,
            'sort_order' => 3,
        ]);

        Category::create([
            'name' => 'Chăm sóc trẻ em',
            'slug' => 'cham-soc-tre-em',
            'parent_id' => $sucKhoe->id,
            'is_active' => true,
            'sort_order' => 4,
        ]);

        Category::create([
            'name' => 'Bổ sung năng lượng',
            'slug' => 'bo-sung-nang-luong',
            'parent_id' => $sucKhoe->id,
            'is_active' => true,
            'sort_order' => 5,
        ]);

        Category::create([
            'name' => 'Cải thiện giấc ngủ',
            'slug' => 'cai-thien-giac-ngu',
            'parent_id' => $sucKhoe->id,
            'is_active' => true,
            'sort_order' => 6,
        ]);

        Category::create([
            'name' => 'Cải thiện hệ tiêu hóa',
            'slug' => 'cai-thien-he-tieu-hoa',
            'parent_id' => $sucKhoe->id,
            'is_active' => true,
            'sort_order' => 7,
        ]);

        Category::create([
            'name' => 'Bảo vệ não bộ',
            'slug' => 'bao-ve-nao-bo',
            'parent_id' => $sucKhoe->id,
            'is_active' => true,
            'sort_order' => 8,
        ]);

        Category::create([
            'name' => 'Bảo vệ xương khớp',
            'slug' => 'bao-ve-xuong-khop',
            'parent_id' => $sucKhoe->id,
            'is_active' => true,
            'sort_order' => 9,
        ]);

        Category::create([
            'name' => 'Bảo vệ gan',
            'slug' => 'bao-ve-gan',
            'parent_id' => $sucKhoe->id,
            'is_active' => true,
            'sort_order' => 10,
        ]);

        Category::create([
            'name' => 'Bảo vệ tim mạch',
            'slug' => 'bao-ve-tim-mach',
            'parent_id' => $sucKhoe->id,
            'is_active' => true,
            'sort_order' => 11,
        ]);

        Category::create([
            'name' => 'Cải thiện thị lực',
            'slug' => 'cai-thien-thi-luc',
            'parent_id' => $sucKhoe->id,
            'is_active' => true,
            'sort_order' => 12,
        ]);

        Category::create([
            'name' => 'Tăng cường hệ miễn dịch',
            'slug' => 'tang-cuong-he-mien-dich',
            'parent_id' => $sucKhoe->id,
            'is_active' => true,
            'sort_order' => 13,
        ]);

        // Sản phẩm cân nặng
        $canNang = Category::create([
            'name' => 'Sản phẩm cân nặng',
            'slug' => 'san-pham-can-nang',
            'description' => 'Các sản phẩm hỗ trợ quản lý cân nặng',
            'is_active' => true,
            'sort_order' => 3,
        ]);

        Category::create([
            'name' => 'Hỗ trợ giảm cân',
            'slug' => 'ho-tro-giam-can',
            'parent_id' => $canNang->id,
            'is_active' => true,
            'sort_order' => 1,
        ]);

        Category::create([
            'name' => 'Hỗ trợ tăng cân',
            'slug' => 'ho-tro-tang-can',
            'parent_id' => $canNang->id,
            'is_active' => true,
            'sort_order' => 2,
        ]);

        // Sản phẩm nội tiết
        $noiTiet = Category::create([
            'name' => 'Sản phẩm nội tiết',
            'slug' => 'san-pham-noi-tiet',
            'description' => 'Các sản phẩm hỗ trợ cân bằng nội tiết tố',
            'is_active' => true,
            'sort_order' => 4,
        ]);

        Category::create([
            'name' => 'Sinh lý nữ',
            'slug' => 'sinh-ly-nu',
            'parent_id' => $noiTiet->id,
            'is_active' => true,
            'sort_order' => 1,
        ]);

        Category::create([
            'name' => 'Sinh lý nam',
            'slug' => 'sinh-ly-nam',
            'parent_id' => $noiTiet->id,
            'is_active' => true,
            'sort_order' => 2,
        ]);

        Category::create([
            'name' => 'Cân bằng nội tiết tố',
            'slug' => 'can-bang-noi-tiet-to',
            'parent_id' => $noiTiet->id,
            'is_active' => true,
            'sort_order' => 3,
        ]);

        Category::create([
            'name' => 'Hỗ trợ mãn kinh',
            'slug' => 'ho-tro-man-kinh',
            'parent_id' => $noiTiet->id,
            'is_active' => true,
            'sort_order' => 4,
        ]);
    }
}

