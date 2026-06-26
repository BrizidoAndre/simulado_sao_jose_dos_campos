<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'image_path',
        'content',
        'status',
        'published_at',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected function casts()
    {
        return [
            'published_at' => 'datetime',
        ];
    }
}
