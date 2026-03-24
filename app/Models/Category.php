<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'parent_id',
        'is_active',
        'is_delete',
    ];

    // ===== Quan hệ =====
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // ===== Chặn logic sai ở mức MODEL =====
    protected static function booted()
    {
        static::saving(function ($category) {
            if (!$category->exists) return;

            if ($category->parent_id == $category->id) {
                throw new \Exception('Danh mục không thể là cha của chính nó');
            }

            $childrenIds = $category->getAllChildrenIds();
            if (in_array($category->parent_id, $childrenIds)) {
                throw new \Exception('Không thể chọn danh mục con làm cha');
            }
        });
    }

    // ===== Lấy toàn bộ con + cháu =====
    public function getAllChildrenIds(): array
    {
        $ids = [];

        foreach ($this->children as $child) {
            $ids[] = $child->id;
            $ids = array_merge($ids, $child->getAllChildrenIds());
        }

        return $ids;
    }
}
