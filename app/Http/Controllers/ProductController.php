<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
 
        // if(auth('user-api')->check()){
                     $products =Product::with(['subCategory' ,'image'])->get();
                   //  $images =Image::all();
                                foreach ($products as $product) {
                $images = Image::where('object_id',"=",  $product->id)->get();
         }
         
        // }else{
        // cms.cities.indexخد البيانات وديهم على صفحة ال   
        // cities تحت مسمى ال 
       return response()->view('cms.products.index',['images'=> $images , 'products'=> $products ]);
        
// $products =Product::with('subCategory')->get();
 
 
// return response()->json([
//     'status'=>true,
//     'message' => 'Success',
//     'data'=>$products
// ]);
        // }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
 
        $products =SubCategory::where('status','=','Visible')->get();
        // $products =Product::all();
       
         // فكرة ال المتغير الي بيرتسل هنا بيحمل البيانات على الصفحة المرادة 
        // return response()->view('cms.products.create');
        return response()->view('cms.products.create',['products'=>$products]);

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
            ///'sub_category_id' => 'required',
        ]);
            if(auth('user-api')->check()){
                if(!$valedator->fails()){
                    $products =new Product();
                    $products->name = $request->input('name');
                    $products->description = $request->input('description');
                    $products->price = $request->input('price');
                    $products->stock = $request->input('stock');
                    $products->status = $request->input('status');
                    $products->sub_category_id = $request->input('sub_category_id');
                    $isSaved = $products->save();
                    $image = new Image();
         
                    $imgname =time().'_'.$image->name.'.'.$request->file('images')->extension();
                   // $request->image->move(public_path('images'), $imgname);
                  $request->file('images')->storePubliclyAs('upload',$imgname,['disk'=>'public']);
                    $image->url ='upload/product/'.$imgname;
                    $image->object_type =$image->getKeyType() ;
                    $image->object_id =  $products->id;  //$image->getKeyType() //$image->id  $products->id
                    $image->status = $request->input('status');
                    $isSaved=  $image->save();
             
                    return response()->json(
                        ['message' => $isSaved ? __('Created Successfully') : __('Create Failed!')],
                        $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
                    );
                }else{
                    return response()->json(['message'=>$valedator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);
                }
               }else{
                /// Weeb 
                if(!$valedator->fails()){
                    $products =new Product();
                    $products->name = $request->input('name');
                    $products->description = $request->input('description');
                    $products->price = $request->input('price');
                    $products->stock = $request->input('stock');
                    $products->status = $request->input('status');
                    $products->sub_category_id = $request->input('sub_category_id');
                    $isSaved = $products->save();
                    $image = new Image();
         
                    $imgname =time().'_'.$image->name.'.'.$request->file('images')->extension();
                   // $request->image->move(public_path('images'), $imgname);
                  $request->file('images')->storePubliclyAs('upload',$imgname,['disk'=>'public']);
                    $image->url ='upload/product/'.$imgname;
                    $image->object_type ="Products";
                    $image->object_id = $products->id;  //$image->getKeyType() //$image->id  $products->id
                    $image->status = $request->input('status');
                    $isSaved=  $image->save();
             
                   if($isSaved){
           
                       // هذا السشن علشان احمل معي متغير برسالة  الفلاش علشان يتم استخدامها مرة فقط 
                         session()->flash('message','Products Created succsesfully');
                       // هذا بخليني اذا تم الحفظ يحولني على صفحة العرض 
                      // return redirect()->route('cities.index');
                       // اول ما تخلص اطبعلي الرسالة وارجع لنفس الصفحة 
                     return redirect()->back();
                   }else{
                       return redirect()->back();
                   }
                }
                }
    //     $image = new Image();
         
    //     $imgname =time().'_'.$image->name.'.'.$request->file('images')->extension();
    //    // $request->image->move(public_path('images'), $imgname);
    //   $request->file('images')->storePubliclyAs('upload',$imgname,['disk'=>'public']);
    //     $image->url ='upload/'.$imgname;
    //     $image->object_type ="test";
    //     $image->object_id = 1;
    //     $image->status = $request->input('status');
    //     $isSaved=  $image->save();
    //     return back()
    //     ->with('success','You have successfully upload image.')
    //     ->with('image',$imgname); 
        // $valedator = Validator($request->all(),[
        //     'name' => 'required|string|min:3|max:45',
        //     'description' => 'required|string|min:3|max:100',
        //     'price' => 'required|numeric',
        //     'stock' => 'required|numeric',
        //     'status' => 'nullable|string|in:Visible,InVisible',
        //     ///'sub_category_id' => 'required',
        // ]);
        //     if(auth('user-api')->check()){
        //         if(!$valedator->fails()){
        //             $products =new Product();
        //             $products->name = $request->input('name');
        //             $products->description = $request->input('description');
        //             $products->price = $request->input('price');
        //             $products->stock = $request->input('stock');
        //             $products->status = $request->input('status');
        //             $products->sub_category_id = $request->input('sub_category_id');
        //             $isSaved = $products->save();
            
        //             return response()->json(
        //                 ['message' => $isSaved ? __('Created Successfully') : __('Create Failed!')],
        //                 $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
        //             );
        //         }else{
        //             return response()->json(['message'=>$valedator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);
        //         }
        //        }else{
        //         if(!$valedator->fails()){
        //             $products =new Product();
        //             $products->name = $request->input('name');
        //             $products->description = $request->input('description');
        //             $products->price = $request->input('price');
        //             $products->stock = $request->input('stock');
        //             $products->status = $request->input('status');
        //             $products->sub_category_id = $request->input('sub_category_id');
        //             $isSaved = $products->save();
             
        //            if($isSaved){
           
        //                // هذا السشن علشان احمل معي متغير برسالة  الفلاش علشان يتم استخدامها مرة فقط 
        //                  session()->flash('message','Products Created succsesfully');
        //                // هذا بخليني اذا تم الحفظ يحولني على صفحة العرض 
        //               // return redirect()->route('cities.index');
        //                // اول ما تخلص اطبعلي الرسالة وارجع لنفس الصفحة 
        //              return redirect()->back();
        //            }else{
        //                return redirect()->back();
        //            }
        //         }
        //         }
        
            
    }


   


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
     
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
         
        return response()->view('cms.products.update',['products'=>$product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $products)
    {
        $valedator = Validator($request->all(),[
            'name' => 'required|string|min:3|max:45',
            'description' => 'required|string|min:3|max:100',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'status' => 'nullable|string|in:Visible,InVisible',
            ///'sub_category_id' => 'required',
        ]);
         
            if(auth('user-api')->check()){
                if(!$valedator->fails()){
                   
                    $products->name = $request->input('name');
                    $products->description = $request->input('description');
                    $products->price = $request->input('price');
                    $products->stock = $request->input('stock');
                    $products->status = $request->input('status');
                    $products->sub_category_id = $request->input('sub_category_id');
                    $isSaved = $products->save();
            
                    return response()->json(
                        ['message' => $isSaved ? __('Update Successfully') : __('Update Failed!')],
                        $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
                    );
                }else{
                    return response()->json(['message'=>$valedator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);
                }
               }else{
                if(!$valedator->fails()){
 
                    $products->name = $request->input('name');
                    $products->description = $request->input('description');
                    $products->price = $request->input('price');
                    $products->stock = $request->input('stock');
                    $products->status = $request->input('status');
                    $products->sub_category_id = $request->input('sub_category_id');
                    $isSaved = $products->save();
             
                   if($isSaved){
           
                       // هذا السشن علشان احمل معي متغير برسالة  الفلاش علشان يتم استخدامها مرة فقط 
                         session()->flash('message','Products Update succsesfully');
                       // هذا بخليني اذا تم الحفظ يحولني على صفحة العرض 
                      // return redirect()->route('cities.index');
                       // اول ما تخلص اطبعلي الرسالة وارجع لنفس الصفحة 
                     return redirect()->back();
                   }else{
                       return redirect()->back();
                   }
                }
                }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
            $isDeleted =$product->delete();
            return redirect()->back();                   
    }
}
