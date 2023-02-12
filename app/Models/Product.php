<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
 protected $fillable = ['*','id','name','description','price','stock','status','sub_category_id'];
 
    
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id', 'id');
    }

    public function productOrders()
    {
        return $this->hasMany(OrderProduct::class, 'product_id', 'id');
    }

    public function images()
    {
        // return $this->morphOne(Image::class, 'object');
        // return $this->morphMany(Image::class, 'object');
        return $this->morphMany(Image::class, 'object', 'object_type', 'object_id', 'id');
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'object', 'object_type', 'object_id', 'id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, OrderProduct::class, 'product_id', 'order_id');
    }

    public function information()
    {
        return $this->hasOne(ProductInformation::class, 'product_id', 'id');
    }
}
