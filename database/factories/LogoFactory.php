<?php

namespace Database\Factories;

use App\Models\Logo; // Import model Logo
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage; // Import Storage Facade
use Illuminate\Support\Str; // Import Str để tạo tên file ngẫu nhiên

class LogoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Logo::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Đường dẫn đến thư mục chứa ảnh giả trong public/temp
        $tempPublicPath = public_path('temp/logo_fakes');
        $storageRelativePath = 'logos';

        if (!file_exists($tempPublicPath)) {
            mkdir($tempPublicPath, 0777, true);
        }

        $fakeImages = glob($tempPublicPath . '/*.{jpg,jpeg,png,gif,svg}', GLOB_BRACE);

        if (empty($fakeImages)) {

            $imagePath = 'logos/placeholder.png'; // Hoặc một đường dẫn ảnh lỗi của bạn
            echo "Cảnh báo: Không tìm thấy ảnh giả trong 'public/temp/logo_fakes'. Sử dụng placeholder.\n";
        } else {

            $randomImage = $this->faker->randomElement($fakeImages);
            $fileName = Str::random(40) . '.' . pathinfo($randomImage, PATHINFO_EXTENSION); // Tên file mới ngẫu nhiên
            $destinationPath = $storageRelativePath . '/' . $fileName;

            $copied = Storage::disk('public')->putFileAs($storageRelativePath, new \Illuminate\Http\File($randomImage), $fileName);

            if ($copied) {
                $imagePath = $destinationPath;
            } else {
                $imagePath = 'logos/placeholder.png';
                echo "Lỗi: Không thể copy ảnh từ '$randomImage' sang '$destinationPath'.\n";
            }
        }


        return [
            'name' => $this->faker->word() . ' Logo',
            'image' => $imagePath,
            'active' => $this->faker->boolean(80)
        ];
    }
}
