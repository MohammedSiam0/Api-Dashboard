<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable ,HasRoles;

    //User belongsTo City  
   // مدينة المستخدم
    public function city(){
        return $this->belongsTo(City::class , 'city_id','id');

    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        // apiاخفيت هاي البيانات في ال 
        'email_verified_at',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Find the user instance for the given username.
     *
     * @param  string  $username
     * @return \App\Models\User
     */
    public function findForPassport($username)
    {
        // هذا لو بدي اعمل تسجيل دخول بالجوال او الايميل 
        return $this->where('email', $username)->first();
    }
    /**
     * Validate the password of the user for the Passport password grant.
     *
     * @param  string  $password
     * @return bool
     */


     public function orders()
     {
         return $this->hasMany(Order::class, 'user_id', 'id');
     }
 
     public function orderProducts()
     {
         return $this->hasManyThrough(OrderProduct::class, Order::class, 'user_id', 'order_id');
     }
 
     public function images()
     {
         return $this->morphMany(Image::class, 'object');
     }

    public function validateForPassportPasswordGrant($password)
    {
        return Hash::check($password, $this->password);
    }
}
