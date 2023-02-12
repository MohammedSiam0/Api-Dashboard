<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable = ['*' ,'id','object_type','object_id'];

    public function object()
    {
        return $this->morphTo();
    }
}
