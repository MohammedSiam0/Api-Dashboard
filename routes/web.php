<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AgeChechMiddleware;
use App\Models\Category;
use App\Models\Image;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //   return view('cms.temp');
  return view('cms.parent');
});
//Route::view('/','cms.temp');

Route::prefix('cms/admin')->middleware('auth:admin')->group(function () {
    Route::resource('permission',PermissionController::class);  
    Route::resource('role',RoleController::class);
    Route::resource('admins',AdminController::class);
// هاي الدالة اعملناها كاملة علشان نعطي الرول صلاحيات 
Route::post('role/update-permission',[RoleController::class, 'updateRolePermission']);
 });




// prifixe  بتساعدد علي تجيمع الروابط في بداية موحدة  مثال 
/*
 * cms/admin/mohammed
 * cms/admin/editMohammed
 */ 
// resource   بيتيح عمل فنكشن وحدة فيها 7 راوتس 
Route::prefix('cms/admin')->middleware('auth:web,admin')->group(function () {
    // cities  يفضل يكون  الاسم بالجمع الصحيح علشان يعرف الربط وين 
    Route::resource('cities',CityController::class);
    Route::resource('users',UserController::class);
    Route::resource('permissions',PermissionController::class);
    Route::resource('products',ProductController::class);
    Route::resource('roles',RoleController::class);
    Route::resource('subcategories',SubCategoryController::class);
    Route::resource('categories',CategoryController::class);

 });
                        // guest بخليها توجه المستخدم الي مسجل دخول ما يرجع غير على الصفحة الرئيسية مش ع تسجيل دخول 
//  Route::prefix('cms/admin')->middleware('guest:web,admin')->group(function(){
//  Route::get('login',[AuthController::class,'showLogin'])->name('cms.login');
//  Route::post('login',[AuthController::class,'login']);
//  });

Route::prefix('cms')->middleware('guest:web,admin')->group(function(){
    //Route::get('admin/login',[AuthController::class,'showLogin'])->name('cms.login');
    Route::get('{guard}/login',[AuthController::class,'showLogin'])->name('cms.login');
     Route::post('login',[AuthController::class,'login']);
     Route::get('{guard}/register',[AuthController::class,'showRegister']);
     Route::Post('register',[AuthController::class,'register']);
      });

 Route::prefix('cms/admin')->middleware('auth:web,admin')->group(function(){
                                   // حستدعي زر تسجيل الخروج عن طريق route('cms.logout')
Route::get('logout',[AuthController::class,'logout'])->name('cms.logout');
 });
 
 
//  Route::prefix('cms/admin')->group(function(){  
//   // النيم الي موجود هذا علشان احطه في صفحة علشان تمنع اي حدا يفوت لوحة التحكم اذا مش مسجل دخول وتوجه هنا مسارها كتالي ا
//   //  app / http /middleware / authentication
//   Route::view('login','cms.auth.login')->name('cms.login');
//  });
 
//  Route::get('news/title',function(){
//     echo "News Content Previewed Here";
//     //age تم وضع اسم المدل وير في ملف الكيرنل 
//  })->middleware('age');

// Route::get('news/title',function(){
//     echo "News Content Previewed Here";
//     // لو انا ما  حطيت الاسم في المدل وير بستدعيه مباشرة 
//  })->middleware(AgeChechMiddleware::class);

//             // القيمة المدخل هوا عبارة عن متغير 
// Route::middleware('age:12')->group(function(){
//     // cities  يفضل يكون  الاسم بالجمع الصحيح علشان يعرف الربط وين 
//     Route::get('news/title/b',function(){
//         echo "News (b) Content Previewed Here";
//         // ما تهتم للمدل وير ونفضه عادي 
//     })->withoutMiddleware('age');
//     Route::get('news/title/a',function(){
//         echo "News (a) Content Previewed Here";
//     });

//  });



//   تفعيل الفاكتوري 
Route::get('create-data', function () {
    set_time_limit(1000);
    Category::factory(5)->create()->each(function ($category) {
        $category->subCategories()->saveMany(SubCategory::factory(rand(2, 10))->make())->each(function ($subCategory) {
            $subCategory->products()->saveMany(Product::factory(rand(2, 10))->make())->each(function ($product) {
                $product->images()->saveMany(Image::factory(rand(2, 10))->make());
            });
        });
     });

    User::factory(5)->create()->each(function ($user) {
        $user->orders()->saveMany(Order::factory(rand(2, 10))->make())->each(function ($order) {
            $order->orderDetails()->saveMany(OrderProduct::factory(rand(2, 10))->make());
        });
    });
});