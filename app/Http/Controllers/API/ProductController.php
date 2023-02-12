<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index( )
    {
        // $product = Product::find($product)->image()->with('subCategory')->get();
        // return [
        //     "status" => true,
        //     "data" =>$product,
        //     'message' => "Show Cities !",
        // ];

        //  $users = DB::table('users')->get();
 
        // return view('user.index', ['users' => $users]);
        //  $products=Product::with(['subCategory','productOrders','images','image','orders','information'])->get();
        //  $products=Product::with(['subCategory'])->get();
      
        // foreach ($products as $product) {
        // $image = Image::where('object_id',"=",  $product->id)->get()->last();
        //     }
        //     return response()->json([
        //         'status'=>true,
        //         'message' => 'Success',
        //         'product'=>$products,
        //         'product_image'=>$image 
        //     ]); 
        // $usersDetails = DB::table('products')
        // ->join('products', 'products.id', '=', 'id')// joining the contacts table , where user_id and contact_user_id are same
        // ->select('users.*', 'contacts.phone')
        // ->get();
// return $usersDetails;
            
               
   
            // $jobs = DB::table('addresses')->select(
            //     'addresses.*',
            //     'jobs.job_title as object_name'
            //   )->join('jobs', function($join) use ($bindings){
            //       $join->on('addresses.object_id', '=', 'jobs.id')
            //            ->where('addresses.object_type', '=', $bindings['job']);
            //   });




        //     $data = Product::with(['subCategory' , 'images'=> function ($query) {
        //         // $products=Product::all();
        //         // foreach ($products as $product) {
        //         $query->;
        //          }])->get()->last();

        //          $post = Posts::find($id)->likes()->with('user')->get();
            // $data=Image::all();

       //$products =Product::all();
      // $products =Image::all();
     // object_id
   //   City::where('active',true)
  //  $mulit = DB::get( "images.object_id" ,"=",   "products.id"  ); 
 //     $mulit =   DB::row('images.object_id', '=',  DB::raw('products.id'));
//    ＄users = User::where('name', 'like', '%' . request('search') . '%')->get();

   
   // $mulit = Image::where('object_id', "=" ,$product->id)->get();
    // $products  =Product::with(['subCategory','images'])->take(20)->get();
    // $data = Product::whereHas('products', function ($query) {
    //     //     $query->where('price', '<=', 150);
    //     // }, '>=', 3)->get();
    
//     $data = Product::with(['subCategory' , 'image'=> function ($query) {
//           $products  =Product::with(['subCategory'])->get();
//     foreach ($products as $product) {
//         $query->where('object_id', "=" ,$product->id);
// }
//     }])->get();



//     $data = Product::with(['subCategory' ,'images' => function (   $image) {
//           $products  = Product::all();
//     foreach ($products as $product) {
//        $image = Image::where('object_id',"=", $product->id ) ;
//    }
//     }])->get()->last();


// $mulit = DB::table('images')
//                 ->whereColumn('object_id',  $product )
//                 ->get();
        // return response()->json([
        //     'status'=>true,
        //     'message' => 'Success',
        //     'data'=>$data,
        //     'product_image'=>$products 
        // ]); 
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valedator = Validator($request->all(),[
            'name' => 'required|string|min:3|max:45',
            'description' => 'required|string|min:3|max:100',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'status' => 'nullable|string|in:Visible,InVisible',
            'sub_category_id' => 'required|numeric',
        ]);
         $products = Product::create($request->all());
 
        return response()->json([
            'status' => true,
            'message' => "Product Created successfully!",
            "data" => $products
        ], 200);


        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product = Product::find($product)->images()->with('subCategory')->get();
        return [
            "status" => true,
            "data" =>$product,
            'message' => "Show Cities !",
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $valedator = Validator($request->all(),[
            'name' => 'required|string|min:3|max:45',
            'description' => 'required|string|min:3|max:100',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'status' => 'nullable|string|in:Visible,InVisible',
            'sub_category_id' => 'required|numeric',
        ]);
         $product->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "Product Update successfully!",
            "data" => $product
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return [
            "status" => true,
            "message" => "Product deleted successfully",
            "data" => $product,

        ];
    }
}
