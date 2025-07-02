<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'img_avt', 'short_description', 'content',
        'is_active', 'view', 'user_id'
    ];
    public function user()
{
    return $this->belongsTo(User::class);
}

}
