<?php

namespace Database\Seeders;

use App\Models\PostCategory;
use Illuminate\Database\Seeder;

class PostCategorySeeder extends Seeder
{
    public function run(): void
    {
        PostCategory::create([
            'name' => 'Phát triển sản phẩm khoa học công nghệ',
            'slug' => 'phat-trien-san-pham-khoa-hoc-cong-nghe',
            'description' => 'Tin tức về phát triển sản phẩm ứng dụng khoa học công nghệ',
            'is_active' => true,
        ]);

        PostCategory::create([
            'name' => 'Chứng nhận và giải thưởng',
            'slug' => 'chung-nhan-va-giai-thuong',
            'description' => 'Tin tức về các chứng nhận và giải thưởng đạt được',
            'is_active' => true,
        ]);

        PostCategory::create([
            'name' => 'Khoa học công nghệ và ứng dụng chuyển giao',
            'slug' => 'khoa-hoc-cong-nghe-va-ung-dung-chuyen-giao',
            'description' => 'Tin tức về khoa học công nghệ và ứng dụng chuyển giao',
            'is_active' => true,
        ]);

        PostCategory::create([
            'name' => 'Kết quả nghiên cứu mới',
            'slug' => 'ket-qua-nghien-cuu-moi',
            'description' => 'Tin tức về các kết quả nghiên cứu mới nhất',
            'is_active' => true,
        ]);
    }
}

