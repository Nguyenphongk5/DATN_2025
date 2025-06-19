<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    //
    protected $fillable = [
        'title',
        'slug',
        'img_avt',
        'short_description',
        'content',
        'user_id',
    ];
    public function user()
{
    return $this->belongsTo(User::class);
}

}
