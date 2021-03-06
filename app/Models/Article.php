<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'tagline', 'text', 'user_id'];

    public function categories() {
        return $this
            ->belongsToMany(Category::class, 'article_categories')
            ->withTimestamps();
    }
}
