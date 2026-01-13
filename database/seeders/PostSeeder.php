<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('is_admin', true)->first();
        if (!$admin) {
            $admin = User::first();
        }

        $categories = PostCategory::all()->keyBy('slug');

        $posts = [
            // Phát triển sản phẩm khoa học công nghệ
            [
                'title' => 'Ứng dụng công nghệ Liposomal trong sản phẩm bổ sung dinh dưỡng',
                'slug' => 'ung-dung-cong-nghe-liposomal-trong-san-pham-bo-sung-dinh-duong',
                'excerpt' => 'Công nghệ Liposomal là một bước đột phá trong việc cải thiện khả năng hấp thụ các chất dinh dưỡng, giúp tăng hiệu quả sử dụng sản phẩm lên nhiều lần.',
                'content' => '<h2>Giới thiệu về công nghệ Liposomal</h2>
<p>Công nghệ Liposomal là một phương pháp tiên tiến trong việc bảo vệ và vận chuyển các hoạt chất đến đúng vị trí cần thiết trong cơ thể. Công nghệ này sử dụng các hạt liposome - những túi nhỏ có màng kép phospholipid - để bao bọc các chất dinh dưỡng.</p>

<h3>Ưu điểm của công nghệ Liposomal</h3>
<ul>
<li><strong>Tăng khả năng hấp thụ:</strong> Liposome bảo vệ các chất dinh dưỡng khỏi sự phân hủy trong hệ tiêu hóa, giúp chúng được hấp thụ tốt hơn.</li>
<li><strong>Bảo vệ hoạt chất:</strong> Màng liposome bảo vệ các chất dinh dưỡng khỏi axit dạ dày và enzyme tiêu hóa.</li>
<li><strong>Vận chuyển hiệu quả:</strong> Liposome có thể vận chuyển các chất dinh dưỡng trực tiếp vào tế bào.</li>
<li><strong>Giảm tác dụng phụ:</strong> Giảm thiểu các tác dụng phụ không mong muốn.</li>
</ul>

<h3>Ứng dụng trong sản phẩm của chúng tôi</h3>
<p>Chúng tôi đã ứng dụng công nghệ Liposomal vào các sản phẩm như:</p>
<ul>
<li>Codeage Liposomal NAD+ - Hỗ trợ chống lão hóa</li>
<li>Codeage Liposomal Magnesium Glycinate - Hỗ trợ giấc ngủ</li>
<li>Codeage Liposomal NMN - Tăng cường năng lượng</li>
</p>

<h3>Kết luận</h3>
<p>Công nghệ Liposomal đại diện cho tương lai của các sản phẩm bổ sung dinh dưỡng, mang lại hiệu quả vượt trội so với các phương pháp truyền thống.</p>',
                'category_slug' => 'phat-trien-san-pham-khoa-hoc-cong-nghe',
                'is_published' => true,
                'published_at' => now()->subDays(10),
                'views' => 1250,
                'meta_title' => 'Công nghệ Liposomal trong sản phẩm bổ sung dinh dưỡng',
                'meta_description' => 'Tìm hiểu về công nghệ Liposomal và ứng dụng trong các sản phẩm bổ sung dinh dưỡng hiện đại.',
            ],
            [
                'title' => 'Nghiên cứu mới về tác dụng của NAD+ trong chống lão hóa',
                'slug' => 'nghien-cuu-moi-ve-tac-dung-cua-nad-plus-trong-chong-lao-hoa',
                'excerpt' => 'NAD+ (Nicotinamide Adenine Dinucleotide) là một coenzyme quan trọng trong quá trình trao đổi chất và sửa chữa DNA, đóng vai trò then chốt trong việc chống lão hóa.',
                'content' => '<h2>NAD+ là gì?</h2>
<p>NAD+ (Nicotinamide Adenine Dinucleotide) là một coenzyme có mặt trong tất cả các tế bào sống. Nó đóng vai trò quan trọng trong quá trình trao đổi chất, chuyển đổi thức ăn thành năng lượng.</p>

<h3>Tác dụng của NAD+</h3>
<ul>
<li><strong>Sửa chữa DNA:</strong> NAD+ kích hoạt các enzyme sửa chữa DNA, giúp bảo vệ tế bào khỏi tổn thương.</li>
<li><strong>Tăng cường năng lượng:</strong> NAD+ tham gia vào quá trình sản xuất ATP - nguồn năng lượng chính của tế bào.</li>
<li><strong>Chống lão hóa:</strong> NAD+ kích hoạt các sirtuin - protein liên quan đến tuổi thọ và sức khỏe.</li>
<li><strong>Cải thiện chức năng não:</strong> NAD+ hỗ trợ sức khỏe não bộ và chức năng nhận thức.</li>
</ul>

<h3>Nghiên cứu khoa học</h3>
<p>Nhiều nghiên cứu đã chỉ ra rằng mức độ NAD+ giảm dần theo tuổi tác. Bổ sung NAD+ có thể giúp:</p>
<ul>
<li>Tăng cường năng lượng và sức bền</li>
<li>Cải thiện chức năng nhận thức</li>
<li>Hỗ trợ sức khỏe tim mạch</li>
<li>Làm chậm quá trình lão hóa</li>
</ul>

<h3>Sản phẩm Codeage Liposomal NAD+</h3>
<p>Sản phẩm của chúng tôi sử dụng công nghệ Liposomal để tăng khả năng hấp thụ NAD+, mang lại hiệu quả tối đa.</p>',
                'category_slug' => 'phat-trien-san-pham-khoa-hoc-cong-nghe',
                'is_published' => true,
                'published_at' => now()->subDays(5),
                'views' => 890,
                'meta_title' => 'NAD+ và tác dụng chống lão hóa - Nghiên cứu khoa học',
                'meta_description' => 'Tìm hiểu về NAD+ và vai trò của nó trong việc chống lão hóa và tăng cường sức khỏe.',
            ],

            // Chứng nhận và giải thưởng
            [
                'title' => 'Nongnghiepvathucpham-AFTD.com nhận chứng nhận Hàng nhập khẩu chính ngạch 100%',
                'slug' => 'an-tran-authentic-nhan-chung-nhan-hang-nhap-khau-chinh-ngach-100',
                'excerpt' => 'Chúng tôi tự hào được chứng nhận là đơn vị nhập khẩu chính ngạch 100%, đảm bảo chất lượng và nguồn gốc xuất xứ rõ ràng cho mọi sản phẩm.',
                'content' => '<h2>Chứng nhận Hàng nhập khẩu chính ngạch</h2>
<p>Nongnghiepvathucpham-AFTD.com vinh dự nhận được chứng nhận <strong>Hàng nhập khẩu chính ngạch 100%</strong> từ các cơ quan chức năng, khẳng định cam kết của chúng tôi trong việc cung cấp sản phẩm chất lượng cao với nguồn gốc xuất xứ rõ ràng.</p>

<h3>Ý nghĩa của chứng nhận</h3>
<ul>
<li><strong>Đảm bảo chất lượng:</strong> Tất cả sản phẩm đều được nhập khẩu chính ngạch, có đầy đủ giấy tờ pháp lý.</li>
<li><strong>Nguồn gốc rõ ràng:</strong> Mỗi sản phẩm đều có tem chống hàng giả và mã vạch truy xuất nguồn gốc.</li>
<li><strong>An toàn cho người dùng:</strong> Sản phẩm đã được kiểm định chất lượng trước khi đưa ra thị trường.</li>
<li><strong>Tuân thủ pháp luật:</strong> Hoạt động kinh doanh tuân thủ đầy đủ các quy định của pháp luật Việt Nam.</li>
</ul>

<h3>Cam kết của chúng tôi</h3>
<p>Với chứng nhận này, chúng tôi cam kết:</p>
<ul>
<li>Chỉ nhập khẩu và phân phối sản phẩm chính hãng</li>
<li>Đảm bảo chất lượng và an toàn cho người tiêu dùng</li>
<li>Minh bạch về nguồn gốc xuất xứ</li>
<li>Hỗ trợ khách hàng tối đa trong quá trình sử dụng</li>
</ul>

<h3>Lợi ích cho khách hàng</h3>
<p>Khi mua sản phẩm tại Nongnghiepvathucpham-AFTD.com, khách hàng được đảm bảo:</p>
<ul>
<li>Sản phẩm chính hãng 100%</li>
<li>Giá cả minh bạch, không lo hàng giả</li>
<li>Chế độ bảo hành và đổi trả rõ ràng</li>
<li>Hỗ trợ tư vấn chuyên nghiệp</li>
</ul>',
                'category_slug' => 'chung-nhan-va-giai-thuong',
                'is_published' => true,
                'published_at' => now()->subDays(15),
                'views' => 2100,
                'meta_title' => 'Chứng nhận Hàng nhập khẩu chính ngạch 100% - Nongnghiepvathucpham-AFTD.com',
                'meta_description' => 'Nongnghiepvathucpham-AFTD.com được chứng nhận nhập khẩu chính ngạch 100%, đảm bảo chất lượng và nguồn gốc sản phẩm.',
            ],
            [
                'title' => 'Giải thưởng "Thương hiệu uy tín" năm 2024',
                'slug' => 'giai-thuong-thuong-hieu-uy-tin-nam-2024',
                'excerpt' => 'Nongnghiepvathucpham-AFTD.com vinh dự nhận giải thưởng "Thương hiệu uy tín" năm 2024, ghi nhận những đóng góp của chúng tôi trong việc cung cấp sản phẩm chất lượng cao.',
                'content' => '<h2>Giải thưởng "Thương hiệu uy tín" 2024</h2>
<p>Nongnghiepvathucpham-AFTD.com vinh dự được trao giải thưởng <strong>"Thương hiệu uy tín"</strong> năm 2024, đây là sự ghi nhận cho những nỗ lực không ngừng của chúng tôi trong việc xây dựng thương hiệu và cung cấp sản phẩm chất lượng cao cho người tiêu dùng Việt Nam.</p>

<h3>Tiêu chí đánh giá</h3>
<p>Giải thưởng được trao dựa trên các tiêu chí:</p>
<ul>
<li><strong>Chất lượng sản phẩm:</strong> Sản phẩm đạt tiêu chuẩn chất lượng cao, được người tiêu dùng tin tưởng.</li>
<li><strong>Dịch vụ khách hàng:</strong> Chăm sóc khách hàng chuyên nghiệp, tận tâm.</li>
<li><strong>Uy tín thương hiệu:</strong> Thương hiệu được công nhận và tin tưởng trong ngành.</li>
<li><strong>Đóng góp xã hội:</strong> Có những đóng góp tích cực cho cộng đồng.</li>
</ul>

<h3>Thành tựu đạt được</h3>
<ul>
<li>Hơn 50,000 khách hàng tin tưởng</li>
<li>Hơn 100,000 sản phẩm đã được bán ra</li>
<li>Tỷ lệ hài lòng khách hàng trên 95%</li>
<li>Được đánh giá 5 sao trên các nền tảng thương mại điện tử</li>
</ul>

<h3>Cam kết tiếp tục</h3>
<p>Với giải thưởng này, chúng tôi cam kết sẽ tiếp tục:</p>
<ul>
<li>Nâng cao chất lượng sản phẩm và dịch vụ</li>
<li>Mở rộng danh mục sản phẩm đa dạng</li>
<li>Cải thiện trải nghiệm khách hàng</li>
<li>Đóng góp tích cực cho sức khỏe cộng đồng</li>
</ul>

<p><strong>Cảm ơn quý khách hàng đã tin tưởng và đồng hành cùng chúng tôi!</strong></p>',
                'category_slug' => 'chung-nhan-va-giai-thuong',
                'is_published' => true,
                'published_at' => now()->subDays(8),
                'views' => 1680,
                'meta_title' => 'Giải thưởng Thương hiệu uy tín 2024 - Nongnghiepvathucpham-AFTD.com',
                'meta_description' => 'Nongnghiepvathucpham-AFTD.com nhận giải thưởng Thương hiệu uy tín năm 2024, ghi nhận chất lượng và uy tín.',
            ],

            // Khoa học công nghệ và ứng dụng chuyển giao
            [
                'title' => 'Chuyển giao công nghệ sản xuất viên nang từ Mỹ',
                'slug' => 'chuyen-giao-cong-nghe-san-xuat-vien-nang-tu-my',
                'excerpt' => 'Chúng tôi đã thành công trong việc chuyển giao công nghệ sản xuất viên nang tiên tiến từ Mỹ, áp dụng vào các sản phẩm bổ sung dinh dưỡng chất lượng cao.',
                'content' => '<h2>Chuyển giao công nghệ từ Mỹ</h2>
<p>Nongnghiepvathucpham-AFTD.com tự hào là một trong những đơn vị đầu tiên tại Việt Nam được chuyển giao công nghệ sản xuất viên nang tiên tiến từ các đối tác uy tín tại Mỹ. Công nghệ này giúp nâng cao chất lượng và hiệu quả của các sản phẩm bổ sung dinh dưỡng.</p>

<h3>Đặc điểm công nghệ</h3>
<ul>
<li><strong>Công nghệ Liposomal:</strong> Bảo vệ và tăng khả năng hấp thụ các hoạt chất</li>
<li><strong>Viên nang thực vật:</strong> Thân thiện với môi trường, phù hợp với người ăn chay</li>
<li><strong>Kiểm soát chất lượng:</strong> Quy trình sản xuất đạt tiêu chuẩn GMP</li>
<li><strong>Bảo quản tối ưu:</strong> Công nghệ đóng gói hiện đại, bảo quản hoạt chất tốt nhất</li>
</ul>

<h3>Lợi ích cho người tiêu dùng</h3>
<p>Với công nghệ này, người tiêu dùng được hưởng lợi từ:</p>
<ul>
<li>Hiệu quả hấp thụ cao hơn so với sản phẩm thông thường</li>
<li>Giảm thiểu tác dụng phụ</li>
<li>Chất lượng ổn định, đáng tin cậy</li>
<li>Giá cả hợp lý nhờ sản xuất trong nước</li>
</ul>

<h3>Ứng dụng trong sản phẩm</h3>
<p>Công nghệ này đã được áp dụng vào các dòng sản phẩm:</p>
<ul>
<li>Codeage Liposomal NAD+</li>
<li>Codeage Liposomal Magnesium</li>
<li>Codeage Methylfolate B Complex</li>
<li>Và nhiều sản phẩm khác</li>
</ul>

<h3>Tương lai</h3>
<p>Chúng tôi sẽ tiếp tục nghiên cứu và ứng dụng các công nghệ tiên tiến để mang đến những sản phẩm tốt nhất cho người tiêu dùng Việt Nam.</p>',
                'category_slug' => 'khoa-hoc-cong-nghe-va-ung-dung-chuyen-giao',
                'is_published' => true,
                'published_at' => now()->subDays(12),
                'views' => 1450,
                'meta_title' => 'Chuyển giao công nghệ sản xuất viên nang từ Mỹ',
                'meta_description' => 'Nongnghiepvathucpham-AFTD.com chuyển giao công nghệ sản xuất viên nang tiên tiến từ Mỹ, nâng cao chất lượng sản phẩm.',
            ],
            [
                'title' => 'Ứng dụng AI trong quản lý chất lượng sản phẩm',
                'slug' => 'ung-dung-ai-trong-quan-ly-chat-luong-san-pham',
                'excerpt' => 'Chúng tôi đang ứng dụng trí tuệ nhân tạo (AI) trong quy trình quản lý chất lượng, đảm bảo mỗi sản phẩm đều đạt tiêu chuẩn cao nhất.',
                'content' => '<h2>AI trong quản lý chất lượng</h2>
<p>Nongnghiepvathucpham-AFTD.com đang tiên phong trong việc ứng dụng <strong>Trí tuệ nhân tạo (AI)</strong> vào quy trình quản lý chất lượng sản phẩm, mang lại hiệu quả và độ chính xác cao hơn so với phương pháp truyền thống.</p>

<h3>Ứng dụng AI</h3>
<ul>
<li><strong>Kiểm tra chất lượng tự động:</strong> AI phân tích và phát hiện các lỗi sản phẩm nhanh chóng</li>
<li><strong>Dự đoán nhu cầu:</strong> AI phân tích xu hướng để dự đoán nhu cầu thị trường</li>
<li><strong>Tối ưu kho hàng:</strong> AI giúp quản lý tồn kho hiệu quả</li>
<li><strong>Hỗ trợ khách hàng:</strong> Chatbot AI trả lời câu hỏi khách hàng 24/7</li>
</ul>

<h3>Lợi ích</h3>
<p>Việc ứng dụng AI mang lại:</p>
<ul>
<li>Độ chính xác cao trong kiểm tra chất lượng</li>
<li>Tiết kiệm thời gian và chi phí</li>
<li>Cải thiện trải nghiệm khách hàng</li>
<li>Nâng cao hiệu quả hoạt động</li>
</ul>

<h3>Tương lai</h3>
<p>Chúng tôi sẽ tiếp tục đầu tư và phát triển các ứng dụng AI để phục vụ khách hàng tốt hơn.</p>',
                'category_slug' => 'khoa-hoc-cong-nghe-va-ung-dung-chuyen-giao',
                'is_published' => true,
                'published_at' => now()->subDays(3),
                'views' => 720,
                'meta_title' => 'Ứng dụng AI trong quản lý chất lượng sản phẩm',
                'meta_description' => 'Nongnghiepvathucpham-AFTD.com ứng dụng AI trong quản lý chất lượng, đảm bảo tiêu chuẩn cao nhất.',
            ],

            // Kết quả nghiên cứu mới
            [
                'title' => 'Nghiên cứu mới: Magnesium Glycinate cải thiện chất lượng giấc ngủ',
                'slug' => 'nghien-cuu-moi-magnesium-glycinate-cai-thien-chat-luong-giac-ngu',
                'excerpt' => 'Nghiên cứu mới nhất cho thấy Magnesium Glycinate có khả năng cải thiện đáng kể chất lượng giấc ngủ và giảm các triệu chứng mất ngủ.',
                'content' => '<h2>Nghiên cứu về Magnesium Glycinate</h2>
<p>Một nghiên cứu mới được công bố gần đây đã chứng minh rằng <strong>Magnesium Glycinate</strong> có khả năng cải thiện đáng kể chất lượng giấc ngủ và giảm các triệu chứng mất ngủ.</p>

<h3>Kết quả nghiên cứu</h3>
<p>Nghiên cứu được thực hiện trên 200 người tham gia trong 8 tuần cho thấy:</p>
<ul>
<li><strong>Giảm thời gian đi vào giấc ngủ:</strong> Trung bình giảm 30% thời gian cần thiết để đi vào giấc ngủ</li>
<li><strong>Tăng thời gian ngủ sâu:</strong> Tăng 20% thời gian ngủ sâu (REM sleep)</li>
<li><strong>Cải thiện chất lượng giấc ngủ:</strong> 85% người tham gia báo cáo cải thiện chất lượng giấc ngủ</li>
<li><strong>Giảm thức giấc giữa đêm:</strong> Giảm 40% số lần thức giấc trong đêm</li>
</ul>

<h3>Cơ chế hoạt động</h3>
<p>Magnesium Glycinate hoạt động bằng cách:</p>
<ul>
<li>Kích hoạt hệ thống GABA - chất dẫn truyền thần kinh giúp thư giãn</li>
<li>Giảm hormone cortisol - hormone gây căng thẳng</li>
<li>Hỗ trợ sản xuất melatonin - hormone điều hòa giấc ngủ</li>
<li>Thư giãn cơ bắp, giảm chuột rút</li>
</ul>

<h3>Sản phẩm Codeage Liposomal Magnesium Glycinate</h3>
<p>Sản phẩm của chúng tôi sử dụng công nghệ Liposomal để tăng khả năng hấp thụ Magnesium Glycinate, mang lại hiệu quả tối đa trong việc cải thiện giấc ngủ.</p>

<h3>Kết luận</h3>
<p>Nghiên cứu này khẳng định vai trò quan trọng của Magnesium Glycinate trong việc cải thiện chất lượng giấc ngủ, đặc biệt là khi được bổ sung dưới dạng Liposomal.</p>',
                'category_slug' => 'ket-qua-nghien-cuu-moi',
                'is_published' => true,
                'published_at' => now()->subDays(7),
                'views' => 1950,
                'meta_title' => 'Nghiên cứu: Magnesium Glycinate cải thiện giấc ngủ',
                'meta_description' => 'Nghiên cứu mới chứng minh Magnesium Glycinate cải thiện chất lượng giấc ngủ và giảm mất ngủ.',
            ],
            [
                'title' => 'Phát hiện mới: Vitamin B Complex hỗ trợ chức năng não bộ',
                'slug' => 'phat-hien-moi-vitamin-b-complex-ho-tro-chuc-nang-nao-bo',
                'excerpt' => 'Nghiên cứu mới phát hiện rằng Vitamin B Complex, đặc biệt là Methylfolate, có tác dụng tích cực trong việc hỗ trợ chức năng não bộ và cải thiện trí nhớ.',
                'content' => '<h2>Vitamin B Complex và chức năng não bộ</h2>
<p>Một nghiên cứu đột phá mới đây đã phát hiện ra rằng <strong>Vitamin B Complex</strong>, đặc biệt là dạng <strong>Methylfolate</strong>, có tác dụng tích cực trong việc hỗ trợ chức năng não bộ và cải thiện trí nhớ.</p>

<h3>Phát hiện chính</h3>
<ul>
<li><strong>Cải thiện trí nhớ:</strong> Tăng 25% khả năng ghi nhớ sau 12 tuần sử dụng</li>
<li><strong>Tăng khả năng tập trung:</strong> Cải thiện đáng kể khả năng tập trung và chú ý</li>
<li><strong>Giảm mệt mỏi tinh thần:</strong> Giảm cảm giác mệt mỏi và căng thẳng</li>
<li><strong>Hỗ trợ sức khỏe thần kinh:</strong> Bảo vệ tế bào thần kinh khỏi tổn thương</li>
</ul>

<h3>Vai trò của Methylfolate</h3>
<p>Methylfolate là dạng hoạt động của folate, có vai trò quan trọng trong:</p>
<ul>
<li>Sản xuất chất dẫn truyền thần kinh</li>
<li>Bảo vệ tế bào thần kinh</li>
<li>Hỗ trợ quá trình methyl hóa - quan trọng cho sức khỏe não bộ</li>
<li>Giảm homocysteine - chất liên quan đến suy giảm nhận thức</li>
</ul>

<h3>Sản phẩm Codeage Methylfolate B Complex</h3>
<p>Sản phẩm của chúng tôi cung cấp đầy đủ các vitamin nhóm B ở dạng hoạt động, đặc biệt là Methylfolate, giúp hỗ trợ tối đa chức năng não bộ.</p>

<h3>Kết luận</h3>
<p>Nghiên cứu này mở ra những khả năng mới trong việc sử dụng Vitamin B Complex để hỗ trợ sức khỏe não bộ và cải thiện chất lượng cuộc sống.</p>',
                'category_slug' => 'ket-qua-nghien-cuu-moi',
                'is_published' => true,
                'published_at' => now()->subDays(2),
                'views' => 1100,
                'meta_title' => 'Vitamin B Complex hỗ trợ chức năng não bộ - Nghiên cứu mới',
                'meta_description' => 'Nghiên cứu mới phát hiện Vitamin B Complex, đặc biệt Methylfolate, hỗ trợ chức năng não bộ và cải thiện trí nhớ.',
            ],
            [
                'title' => 'Nghiên cứu: Omega-3 EPA và DHA bảo vệ sức khỏe tim mạch',
                'slug' => 'nghien-cuu-omega-3-epa-va-dha-bao-ve-suc-khoe-tim-mach',
                'excerpt' => 'Nghiên cứu quy mô lớn cho thấy Omega-3, đặc biệt là EPA và DHA, có tác dụng bảo vệ sức khỏe tim mạch và giảm nguy cơ mắc các bệnh tim mạch.',
                'content' => '<h2>Omega-3 và sức khỏe tim mạch</h2>
<p>Một nghiên cứu quy mô lớn với hơn 10,000 người tham gia đã chứng minh rằng <strong>Omega-3</strong>, đặc biệt là <strong>EPA</strong> và <strong>DHA</strong>, có tác dụng bảo vệ sức khỏe tim mạch và giảm đáng kể nguy cơ mắc các bệnh tim mạch.</p>

<h3>Kết quả nghiên cứu</h3>
<ul>
<li><strong>Giảm nguy cơ đau tim:</strong> Giảm 28% nguy cơ đau tim ở người dùng Omega-3 thường xuyên</li>
<li><strong>Giảm cholesterol xấu:</strong> Giảm LDL cholesterol và tăng HDL cholesterol</li>
<li><strong>Hạ huyết áp:</strong> Giảm huyết áp tâm thu trung bình 3-5 mmHg</li>
<li><strong>Chống viêm:</strong> Giảm các dấu hiệu viêm liên quan đến bệnh tim</li>
<li><strong>Bảo vệ mạch máu:</strong> Cải thiện chức năng nội mô mạch máu</li>
</ul>

<h3>Vai trò của EPA và DHA</h3>
<p><strong>EPA (Eicosapentaenoic Acid):</strong></p>
<ul>
<li>Chống viêm mạnh mẽ</li>
<li>Giảm triglyceride</li>
<li>Hỗ trợ sức khỏe tim mạch</li>
</ul>

<p><strong>DHA (Docosahexaenoic Acid):</strong></p>
<ul>
<li>Hỗ trợ chức năng não bộ</li>
<li>Bảo vệ mắt</li>
<li>Hỗ trợ phát triển thần kinh</li>
</ul>

<h3>Sản phẩm Codeage Amen Omega-3</h3>
<p>Sản phẩm của chúng tôi cung cấp hàm lượng cao EPA và DHA từ dầu cá chất lượng cao, được tinh chế để loại bỏ các tạp chất và kim loại nặng.</p>

<h3>Khuyến nghị</h3>
<p>Các chuyên gia khuyến nghị bổ sung ít nhất 500mg EPA + DHA mỗi ngày để duy trì sức khỏe tim mạch tốt.</p>',
                'category_slug' => 'ket-qua-nghien-cuu-moi',
                'is_published' => true,
                'published_at' => now()->subDays(1),
                'views' => 850,
                'meta_title' => 'Omega-3 EPA và DHA bảo vệ sức khỏe tim mạch - Nghiên cứu',
                'meta_description' => 'Nghiên cứu chứng minh Omega-3 EPA và DHA bảo vệ sức khỏe tim mạch và giảm nguy cơ bệnh tim.',
            ],
        ];

        foreach ($posts as $postData) {
            $category = $categories->get($postData['category_slug']);

            if ($category) {
                Post::create([
                    'title' => $postData['title'],
                    'slug' => $postData['slug'],
                    'excerpt' => $postData['excerpt'],
                    'content' => $postData['content'],
                    'category_id' => $category->id,
                    'author_id' => $admin->id,
                    'is_published' => $postData['is_published'],
                    'published_at' => $postData['published_at'],
                    'views' => $postData['views'],
                    'meta_title' => $postData['meta_title'],
                    'meta_description' => $postData['meta_description'],
                ]);
            }
        }
    }
}

