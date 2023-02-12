<?php

use App\Http\Controllers\API\ApiAuthController;
use App\Http\Controllers\API\ProductController as APIProductController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\SubCategoryController;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
                        //sanctum  هذا السطر ديفولتت 
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function(){
    Route::post('login',[ApiAuthController::class,'loginPersonal' ]);    
    // لتشغيل هذا الرابط بالشكل المناسب يجب تشغيل المشروع على بروت مختلف عن البروت الي في
    Route::post('login-pgct',[ApiAuthController::class,'loginPGCT']);
     Route::Post('register',[ApiAuthController::class,'register']);
});
Route::middleware('auth:user-api')->group(function(){
    // هذا لازم اشغل الكنترولر تبع ال api 
 //   Route::apiResource('cities',CityController::class);
 //api هذا خلينا نعمل الكنترولر العادي كمان لل api
     Route::apiResource('cities',CityController::class);
     Route::apiResource('products',ProductController::class);
     Route::apiResource('subcategories',SubCategoryController::class);

});
 
Route::prefix('auth')->middleware('auth:user-api')->group(function(){
    Route::get('logout',[ApiAuthController::class,'logout' ]);
});
 



// Route::get('unicef', function () {
//     $data = Product::max('price');
// return response()->json(['Price Data : ',$data]);
//  });
// Route::get('products', function () {
//     Route::apiResource('products',ProductController::class);


//  });


