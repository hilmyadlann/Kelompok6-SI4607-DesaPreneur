<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'category_id', 'marketplace_link', 'umkm_id', 'likes_count']; //tambahan manda like couunt

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function umkm()
    {
        return $this->belongsTo(Umkm::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //tambahan manda
    public function likedBy()
    {
        return $this->belongsToMany(User::class, 'likes', 'product_id', 'user_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    
}