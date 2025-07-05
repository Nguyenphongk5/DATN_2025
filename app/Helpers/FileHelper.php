<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

class FileHelper
{
    /**
     * Tạo tên file unique cho ảnh sản phẩm
     *
     * @param UploadedFile $file
     * @param string $prefix
     * @return string
     */
    public static function generateUniqueFileName(UploadedFile $file, $prefix = 'product')
    {
        $extension = $file->getClientOriginalExtension();
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        
        // Tạo tên file với timestamp và random string để tránh trùng
        $timestamp = now()->format('YmdHis');
        $randomString = Str::random(8);
        
        // Loại bỏ ký tự đặc biệt và thay thế khoảng trắng bằng dấu gạch ngang
        $cleanName = preg_replace('/[^a-zA-Z0-9\-\_]/', '-', $originalName);
        $cleanName = preg_replace('/-+/', '-', $cleanName);
        $cleanName = trim($cleanName, '-');
        
        // Giới hạn độ dài tên file
        if (strlen($cleanName) > 50) {
            $cleanName = substr($cleanName, 0, 50);
        }
        
        return "{$prefix}_{$cleanName}_{$timestamp}_{$randomString}.{$extension}";
    }

    /**
     * Upload file với tên unique
     *
     * @param UploadedFile $file
     * @param string $path
     * @param string $prefix
     * @return string
     */
    public static function uploadFile(UploadedFile $file, $path = 'product_images', $prefix = 'product')
    {
        $fileName = self::generateUniqueFileName($file, $prefix);
        return $file->storeAs($path, $fileName, 'public');
    }

    /**
     * Xóa file cũ nếu tồn tại
     *
     * @param string $filePath
     * @return bool
     */
    public static function deleteFile($filePath)
    {
        if ($filePath && \Storage::disk('public')->exists($filePath)) {
            return \Storage::disk('public')->delete($filePath);
        }
        return false;
    }
} 