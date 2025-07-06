<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Support\Facades\Storage;

class ProductGallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();

        foreach ($products as $product) {
            // Tạo 3-5 ảnh cho mỗi sản phẩm
            $imageCount = rand(3, 5);
            
            for ($i = 1; $i <= $imageCount; $i++) {
                $fileName = "product_gallery_{$product->id}_{$i}_" . time() . ".jpg";
                
                // Tạo ảnh mẫu (có thể thay thế bằng ảnh thật)
                $imageContent = $this->createSampleImage($product->name, $i);
                
                // Lưu file
                Storage::disk('public')->put('product_galleries/' . $fileName, $imageContent);
                
                // Tạo record trong database
                ProductGallery::create([
                    'product_id' => $product->id,
                    'image' => $fileName,
                    'alt_text' => "Ảnh {$i} của {$product->name}",
                    'sort_order' => $i,
                    'is_active' => true,
                ]);
            }
        }
    }

    /**
     * Tạo ảnh mẫu (placeholder)
     */
    private function createSampleImage($productName, $index)
    {
        // Tạo một ảnh placeholder đơn giản
        $width = 800;
        $height = 600;
        
        // Tạo ảnh với GD
        $image = imagecreate($width, $height);
        
        // Màu nền
        $bgColor = imagecolorallocate($image, 240, 240, 240);
        
        // Màu chữ
        $textColor = imagecolorallocate($image, 100, 100, 100);
        
        // Vẽ text
        $text = "{$productName} - Ảnh {$index}";
        $fontSize = 5;
        $textWidth = imagefontwidth($fontSize) * strlen($text);
        $textHeight = imagefontheight($fontSize);
        
        $x = ($width - $textWidth) / 2;
        $y = ($height - $textHeight) / 2;
        
        imagestring($image, $fontSize, $x, $y, $text, $textColor);
        
        // Output ảnh
        ob_start();
        imagejpeg($image, null, 90);
        $imageData = ob_get_contents();
        ob_end_clean();
        
        imagedestroy($image);
        
        return $imageData;
    }
} 