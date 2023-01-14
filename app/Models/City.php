<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class City extends Model
{
    //  مستخدمين المدينة 
 // City has Users
    public function users(){
    // لو متبعين التسميات الصح ف هذا  السطر يكفي 
    // return $this->hasMany(User::class);
    return $this->hasMany(User::class , 'city_id','id');
    }

    use HasFactory;
    protected $fillable = [
        'name_en',
        'name_ar',
        'active',
    ];
    // علشان نتعامل معها في الapi  
    // انه مش كولم في الداتا بيز هاي تم الحاقها 
    // protected $appends =['active_stauts']; 


    // علشان اخلي القيمة بدل 0 / 1  اخليها Active or InActiver

    // هذا الشكل الاساسي للفنكشن 
    // public function getـــــAttribute(){
    // }
    // ممنوع احط في النص اسم جدول مثلا كلمة أكتف  لهالها 
    // طريقة استدعائها في صفحات الblade       ==>   active_status 
    // يتم ازالة اول كلمة والاخيرة ويتم وضع علامة _ بين الكلمتين 
    public function getActiveStatusAttribute(){
        return $this->active ? 'Active' : 'Disabled';
    }

}


// create this alter use this commund 
////// php artisan make:migration add_city_id_to_users_table


// public function up()
// {
//     Schema::table('users', function (Blueprint $table) {
//         //
//         // $table->foreignId('city_id')->after('password');
//         // $table->foreign('city_id')->references('id')->on('cities');

//         // $table->foreignIdFor(City::class);
//         //  $table->foreign('city_id')->references('id')->on('cities');
//         //    $table->foreignId('city_id')->constrained();

//           $table->foreignIdFor(City::class)->constrained();

//     });
// }
// /**
//  * Reverse the migrations.
//  *
//  * @return void
//  */
// public function down()
// {
//     Schema::table('users', function (Blueprint $table) {
//         $table->dropForeign('user_city_id_foreign');
//         $table->dropColumn('city_id');
//             });
// }