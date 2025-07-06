<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'image',
        'alt_text',
        'sort_order'
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    /**
     * Quan hệ với Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Tạo tên file duy nhất
     */
    public static function generateUniqueFileName($originalName, $productId)
    {
        $extension = pathinfo($originalName, PATHINFO_EXTENSION);
        $baseName = pathinfo($originalName, PATHINFO_FILENAME);
        
        // Loại bỏ ký tự đặc biệt và thay thế bằng dấu gạch ngang
        $cleanName = Str::slug($baseName);
        
        // Tạo tên file với timestamp để đảm bảo duy nhất
        $fileName = $cleanName . '_' . time() . '_' . $productId . '.' . $extension;
        
        return $fileName;
    }

    /**
     * Kiểm tra tên file đã tồn tại chưa
     */
    public static function isFileNameExists($fileName)
    {
        return self::where('image', $fileName)->exists();
    }

    /**
     * Scope để lấy ảnh theo thứ tự
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }

    /**
     * Scope để lấy ảnh active
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
} 