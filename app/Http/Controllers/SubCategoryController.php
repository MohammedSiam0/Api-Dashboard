<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          // $products =Product::with('subCategory')->get();
          // $products =Product::with('subCategory')->get();
            $subCategories =SubCategory::all();
        //   $subCategories =SubCategory::with('Category')->get();

          
          if(auth('user-api')->check()){

            return response()->json([
                'status'=>true,
                'message' => 'Success',
                'data'=>$subCategories
            ]);
        }else{
        // cms.cities.indexخد البيانات وديهم على صفحة ال   
        // cities تحت مسمى ال 
       return response()->view('cms.subCategory.index',['subCategories'=> $subCategories]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    //   $Categories =SubCategory::with('Category')->get();
      //  $Categories =Category::with('SubCategory')->get();
        //   $Categories =Category::all();
         // $categories =Category::where('status','=','Visible')->get();
        //   return response()->view('cms.subCategory.create',['categories'=>$categories]);
           $category =Category::get(['id' ,'title']);
         // $category =Category::all();
          $subCategories =SubCategory::all();
          return response()->view('cms.subCategory.create',['subCategories'=>$subCategories ,'category'=>$category]);
       
           
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
            'title' => 'required|string|min:3|max:45',
            // 'title' => 'required|string|min:3|max:45',
            'description' => 'required|string|min:3|max:100',
            
              'status' => 'nullable|string|in:Visible,InVisible',
           // 'status' => 'accepted'
              'category_id' => 'required|numeric|exists:categories,id',

        ]);
     
        if(auth('user-api')->check()){
             $subCategores =new SubCategory();
            $subCategores->title = $request->input('title');
            $subCategores->description = $request->input('description');  
            // $subCategores->status = $request->input('status');  
            // if($request->has('status')){
            //     $subCategores->status = $request->input('Visible');      

            // }else{
            //     // $subCategores->status = $request->input('InVisible');   
            //     $request->merge(['InVisible' => 0]);

            // }    
            $subCategores->status = $request->input('status');      
        //    $subCategores->status = $request->has('status')  ?? "Visible";
            $subCategores->category_id = $request->input('category_id');      
             $subCategores->save();

             return response()->json([
                 'status' => true,
                 'message' => "subCategores Created successfully!",
                 "data" => $subCategores
             ], 200);

         }else{
            if(!$valedator->fails()){

              //  $this->authorize('create',City::class);
               $subCategores =new SubCategory();
               $subCategores->title = $request->input('title');
               $subCategores->description = $request->input('description');      
               $subCategores->status = $request->input('status');      
            //    if($request->has('status')){
            //     $subCategores->status = $request->input('Visible');      

            // }else{
            //     $subCategores->status = $request->input('InVisible');   
            // }      
              //$subCategores->status = $request->has('status')  ?? "Visible";
              $subCategores->category_id = $request->input('category_id');      
              
             // dd(" test ");
              // dd($subCategores);

              $isSaved = $subCategores->save();

            
               if($isSaved){
     
                 // هذا السشن علشان احمل معي متغير برسالة  الفلاش علشان يتم استخدامها مرة فقط 
                   session()->flash('message','subCategores Created succsesfully');
                 // هذا بخليني اذا تم الحفظ يحولني على صفحة العرض 
                // return redirect()->route('cities.index');
                 // اول ما تخلص اطبعلي الرسالة وارجع لنفس الصفحة 
               return redirect()->back();
             }else{
                 return redirect()->back();
             }
        //     return redirect()->back();
        // }else{
        //     return response()->json(['message'=>$valedator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);
          }
          }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subCategory)
    {
        $category =Category::get(['id' ,'title']);
        // $category =Category::all();
         $subCategories =SubCategory::all();
         return response()->view('cms.subCategory.update',['subCategories'=>$subCategories ,'category'=>$category]);
      
 

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request ,SubCategory $subCategory )
    {
        $valedator = Validator($request->all(),[
            'title' => 'required|string|min:3|max:45',
            // 'title' => 'required|string|min:3|max:45',
            'description' => 'required|string|min:3|max:100',
            
              'status' => 'nullable|string|in:Visible,InVisible',
           // 'status' => 'accepted'
              'category_id' => 'required|numeric|exists:categories,id',

        ]);
     
        if(auth('user-api')->check()){
 
            $subCategory->title = $request->input('title');
            $subCategory->description = $request->input('description');  
       
            $subCategory->status = $request->input('status');      
             $subCategory->category_id = $request->input('category_id');      
             $subCategory->save();

             return response()->json([
                 'status' => true,
                 'message' => "subCategory Created successfully!",
                 "data" => $subCategory
             ], 200);

         }else{
            if(!$valedator->fails()){

              //  $this->authorize('create',City::class);
          
               $subCategory->title = $request->input('title');
               $subCategory->description = $request->input('description');      
               $subCategory->status = $request->input('status');      
      
              $subCategory->category_id = $request->input('category_id');      
              
          

              $isSaved = $subCategory->save();

            
               if($isSaved){
     
                    session()->flash('message','subCategory Created succsesfully');
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
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subCategory)
    {
  
      $isDeleted =$subCategory->delete();
         return redirect()->back();
    //     if(auth('user-api')->check()){
       
             
    //      }else {
    //     //    $this->authorize('delete',$city);
    //        $isDeleted =$subCategory->delete();
    //      if($isDeleted){
    //             return redirect()->back();
    //      }else{
    //          return redirect()->back();
    //      }
    // }
  
    }
    }
 
