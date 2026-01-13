<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::whereNotNull('parent_id')->get()->keyBy('slug');

        $products = [
            // Chống lão hóa
            [
                'name' => 'Codeage Liposomal NAD+ Viên Uống Hỗ Trợ Chống Lão Hóa, Hỗ Trợ Sức Khoẻ - Nhập Khẩu Chính Ngạch Đủ 2 Tem - Hộp 60v',
                'slug' => 'codeage-liposomal-nad-plus',
                'short_description' => 'Viên uống chống lão hóa và tăng cường sức khỏe',
                'description' => 'Codeage Liposomal NAD+ là sản phẩm bổ sung NAD+ với công nghệ liposomal giúp hấp thụ tối đa. Sản phẩm hỗ trợ chống lão hóa, tăng cường năng lượng và sức khỏe tổng thể.',
                'price' => 2650000,
                'sale_price' => 2252000,
                'sku' => 'CODE-NAD-60',
                'stock' => 50,
                'category_slug' => 'ho-tro-chong-lao-hoa',
                'is_featured' => true,
                'rating' => 5.0,
                'rating_count' => 15,
                'sales_count' => 15,
            ],
            [
                'name' => 'Codeage Liposomal Magnesium Glycinate – Hỗ trợ giấc ngủ, giảm mệt mỏi và chuột rút - Nhập khẩu chính ngạch đủ 2 tem - hộp 240v',
                'slug' => 'codeage-liposomal-magnesium-glycinate',
                'short_description' => 'Viên bổ sung Magie sinh học hấp thụ tối đa',
                'description' => 'Codeage Liposomal Magnesium Glycinate với công nghệ liposomal giúp hấp thụ magie tối đa. Hỗ trợ giấc ngủ, giảm mệt mỏi và chuột rút hiệu quả.',
                'price' => 1620000,
                'sale_price' => 1378000,
                'sku' => 'CODE-MG-240',
                'stock' => 30,
                'category_slug' => 'cai-thien-giac-ngu',
                'is_featured' => true,
                'rating' => 5.0,
                'rating_count' => 20,
                'sales_count' => 20,
            ],
            [
                'name' => 'Viên Bổ Não Codeage Methylfolate B Complex - Hỗ Trợ Trí Nhớ Và Khả Năng Tập Trung - Nhập Khẩu Chính Ngạch Đủ 2 Tem - 120v',
                'slug' => 'codeage-methylfolate-b-complex',
                'short_description' => 'Viên bổ não tăng cường trí nhớ và khả năng tập trung',
                'description' => 'Codeage Methylfolate B Complex với các vitamin nhóm B và methylfolate giúp hỗ trợ chức năng não bộ, tăng cường trí nhớ và khả năng tập trung.',
                'price' => 1390000,
                'sale_price' => 1182000,
                'sku' => 'CODE-B-120',
                'stock' => 40,
                'category_slug' => 'bao-ve-nao-bo',
                'is_featured' => true,
                'rating' => 5.0,
                'rating_count' => 21,
                'sales_count' => 21,
            ],
            [
                'name' => 'Codeage Hair Vitamins Hỗ Trợ Tóc Chắc Khỏe - Nhập Khẩu Chính Ngạch Đủ 2 Tem - 120v',
                'slug' => 'codeage-hair-vitamins',
                'short_description' => 'Viên uống hỗ trợ mọc và dưỡng tóc',
                'description' => 'Codeage Hair Vitamins với các vitamin và khoáng chất cần thiết giúp hỗ trợ tóc chắc khỏe, mọc nhanh và giảm rụng tóc hiệu quả.',
                'price' => 1590000,
                'sale_price' => 1352000,
                'sku' => 'CODE-HAIR-120',
                'stock' => 35,
                'category_slug' => 'ho-tro-toc',
                'is_featured' => true,
                'rating' => 5.0,
                'rating_count' => 23,
                'sales_count' => 23,
            ],
            [
                'name' => 'Viên Dầu Cá Codeage Amen Omega-3 - Hỗ Trợ Tim Mạch, Chức Năng Não Và Mắt - Nhập Khẩu Chính Ngạch Đủ 2 Tem - hộp 90v',
                'slug' => 'codeage-amen-omega-3',
                'short_description' => 'Viên dầu cá hỗ trợ sức khỏe tim mạch và chức năng não',
                'description' => 'Codeage Amen Omega-3 với hàm lượng cao EPA và DHA giúp hỗ trợ sức khỏe tim mạch, chức năng não và mắt. Sản phẩm được nhập khẩu chính ngạch đủ 2 tem.',
                'price' => 1390000,
                'sale_price' => 1182000,
                'sku' => 'CODE-OMEGA-90',
                'stock' => 45,
                'category_slug' => 'bao-ve-tim-mach',
                'is_featured' => true,
                'rating' => 5.0,
                'rating_count' => 30,
                'sales_count' => 30,
            ],
            [
                'name' => 'Elasten Collagen Dạng Nước Giúp Trẻ Hóa Da, Sáng Da',
                'slug' => 'elasten-collagen',
                'short_description' => 'Collagen dạng nước giúp trẻ hóa và sáng da',
                'description' => 'Elasten Collagen dạng nước với hàm lượng collagen cao giúp cải thiện độ đàn hồi da, giảm nếp nhăn và làm sáng da hiệu quả.',
                'price' => 2500000,
                'sale_price' => 2200000,
                'sku' => 'ELASTEN-COL-1',
                'stock' => 25,
                'category_slug' => 'lam-dep-da',
                'is_featured' => true,
                'rating' => 4.8,
                'rating_count' => 45,
                'sales_count' => 45,
            ],
            [
                'name' => 'Viên Nội Tiết Tố Manhae Của Pháp Giảm các triệu chứng của mãn kinh, tiền mãn kinh',
                'slug' => 'manhae-menopause',
                'short_description' => 'Viên nội tiết tố giảm triệu chứng mãn kinh',
                'description' => 'Manhae Menopause là sản phẩm nội tiết tố của Pháp giúp giảm các triệu chứng của mãn kinh và tiền mãn kinh như bốc hỏa, mất ngủ, cáu gắt.',
                'price' => 1800000,
                'sale_price' => 1600000,
                'sku' => 'MANHAE-MEN-1',
                'stock' => 30,
                'category_slug' => 'ho-tro-man-kinh',
                'is_featured' => true,
                'rating' => 4.9,
                'rating_count' => 38,
                'sales_count' => 38,
            ],
            [
                'name' => 'Liposomal NMN Codeage Giúp tăng cường sinh lực và năng lượng',
                'slug' => 'codeage-liposomal-nmn',
                'short_description' => 'NMN liposomal tăng cường sinh lực và năng lượng',
                'description' => 'Codeage Liposomal NMN với công nghệ liposomal giúp hấp thụ NMN tối đa. Sản phẩm giúp tăng cường sinh lực, năng lượng và hỗ trợ chống lão hóa từ bên trong.',
                'price' => 3200000,
                'sale_price' => 2800000,
                'sku' => 'CODE-NMN-1',
                'stock' => 20,
                'category_slug' => 'ho-tro-chong-lao-hoa',
                'is_featured' => true,
                'rating' => 5.0,
                'rating_count' => 28,
                'sales_count' => 28,
            ],
            [
                'name' => 'Codeage ADK Vitamins Hỗ Trợ Miễn Dịch Và Sức Khỏe Xương - Nhập Khẩu Chính Ngạch Đủ 2 Tem',
                'slug' => 'codeage-adk-vitamins',
                'short_description' => 'Vitamin ADK 3-trong-1 tăng cường sức khỏe',
                'description' => 'Codeage ADK Vitamins là sản phẩm bổ sung vitamin A, D và K với tỷ lệ tối ưu. Hỗ trợ hệ miễn dịch, sức khỏe xương và nhiều chức năng quan trọng khác.',
                'price' => 1500000,
                'sale_price' => 1300000,
                'sku' => 'CODE-ADK-1',
                'stock' => 35,
                'category_slug' => 'tang-cuong-he-mien-dich',
                'is_featured' => false,
                'rating' => 4.7,
                'rating_count' => 22,
                'sales_count' => 22,
            ],
            [
                'name' => 'Viên Uống Hỗ Trợ Giảm Cân Codeage',
                'slug' => 'codeage-weight-loss',
                'short_description' => 'Hỗ trợ giảm cân an toàn và hiệu quả',
                'description' => 'Sản phẩm hỗ trợ giảm cân với các thành phần tự nhiên giúp tăng cường trao đổi chất, đốt cháy mỡ thừa và kiểm soát cảm giác thèm ăn.',
                'price' => 1200000,
                'sale_price' => 1000000,
                'sku' => 'CODE-WL-1',
                'stock' => 40,
                'category_slug' => 'ho-tro-giam-can',
                'is_featured' => false,
                'rating' => 4.5,
                'rating_count' => 18,
                'sales_count' => 18,
            ],
        ];

        foreach ($products as $productData) {
            $category = $categories->get($productData['category_slug']);
            
            if ($category) {
                Product::create([
                    'name' => $productData['name'],
                    'slug' => $productData['slug'],
                    'short_description' => $productData['short_description'],
                    'description' => $productData['description'],
                    'price' => $productData['price'],
                    'sale_price' => $productData['sale_price'] ?? null,
                    'sku' => $productData['sku'],
                    'stock' => $productData['stock'],
                    'category_id' => $category->id,
                    'is_active' => true,
                    'is_featured' => $productData['is_featured'] ?? false,
                    'rating' => $productData['rating'] ?? 0,
                    'rating_count' => $productData['rating_count'] ?? 0,
                    'sales_count' => $productData['sales_count'] ?? 0,
                ]);
            }
        }
    }
}

