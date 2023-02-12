<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
     // protected $with = ['subCategories'];
    // protected $withCount = [];
    // protected $primaryKey = 'id';
    public function subCategories()
    {
        // return $this->hasMany(SubCategory::class);
        return $this->hasMany(SubCategory::class, 'category_id', 'id');
    }

    public function products()
    {
        return $this->hasManyThrough(Product::class, SubCategory::class, 'category_id', 'sub_category_id');
    }
}
