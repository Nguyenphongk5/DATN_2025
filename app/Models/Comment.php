<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'content',
        'rating',
        'parent_id',
        'is_active',
        'image',
    ];

    /**
     * Bình luận thuộc về người dùng
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Bình luận thuộc về sản phẩm
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Bình luận cha
     */
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    /**
     * Các bình luận con (reply)
     */
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')
            ->where('is_active', 1)
            ->orderBy('created_at', 'asc');
    }

    /**
     * Scope: chỉ lấy bình luận cha
     */
    public function scopeParents($query)
    {
        return $query->whereNull('parent_id');
    }

    /**
     * Scope: chỉ lấy bình luận con
     */
    public function scopeChildren($query)
    {
        return $query->whereNotNull('parent_id');
    }
}
