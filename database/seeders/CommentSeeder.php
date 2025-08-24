<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\Product;
use App\Models\User;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();
        $users = User::all();

        if ($products->isEmpty() || $users->isEmpty()) {
            return;
        }

        foreach ($products as $product) {
            // Tạo 3-8 đánh giá cho mỗi sản phẩm
            $commentCount = rand(3, 8);
            
            for ($i = 0; $i < $commentCount; $i++) {
                $user = $users->random();
                $rating = rand(1, 5);
                
                Comment::create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'content' => $this->getRandomComment($rating),
                    'rating' => $rating,
                    'is_active' => 1,
                ]);
            }
        }
    }

    private function getRandomComment($rating): string
    {
        $comments = [
            5 => [
                'Sản phẩm rất tốt, chất lượng cao!',
                'Tuyệt vời, đúng như mô tả!',
                'Rất hài lòng với sản phẩm này!',
                'Chất lượng tốt, giao hàng nhanh!',
                'Sản phẩm đẹp, giá cả hợp lý!'
            ],
            4 => [
                'Sản phẩm tốt, đáng mua!',
                'Chất lượng khá tốt!',
                'Hài lòng với sản phẩm!',
                'Đúng như mong đợi!',
                'Sản phẩm đẹp!'
            ],
            3 => [
                'Sản phẩm tạm được!',
                'Chất lượng bình thường!',
                'Có thể chấp nhận được!',
                'Không tệ lắm!',
                'Tạm ổn!'
            ],
            2 => [
                'Chất lượng không tốt lắm!',
                'Hơi thất vọng!',
                'Không như mong đợi!',
                'Cần cải thiện!',
                'Chưa hài lòng!'
            ],
            1 => [
                'Chất lượng kém!',
                'Rất thất vọng!',
                'Không nên mua!',
                'Sản phẩm không tốt!',
                'Không hài lòng!'
            ]
        ];

        return $comments[$rating][array_rand($comments[$rating])];
    }
}
