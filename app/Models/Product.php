<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Các cột cho phép insert / update
    protected $fillable = [
        'category_id',
        'name',
        'sku',
        'price',
        'sale_price',
        'stock',
        'description',
        'image',
        'is_active',
        'is_delete'
    ];

    // Quan hệ
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
