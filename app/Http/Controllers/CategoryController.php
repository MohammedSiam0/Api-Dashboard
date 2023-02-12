<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Categories =Category::all();

        if(auth('user-api')->check()){
          return response()->json([
              'status'=>true,
              'message' => 'Success',
              'data'=>$Categories
          ]);
      }else{
      // cms.cities.indexخد البيانات وديهم على صفحة ال   
      // cities تحت مسمى ال 
     return response()->view('cms.category.index',['Categories'=> $Categories]);
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $Categories =Category::all();
 
        return response()->view('cms.category.create',['Categories'=>$Categories]);


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
            'description' => 'required|string|min:3|max:100',        
            'status' => 'nullable|string|in:Visible,InVisible',
        ]);
        if(auth('user-api')->check()){
           
              $Categores =new Category();
              $Categores->title = $request->input('title');
              $Categores->description = $request->input('description');      
            //   $Categores->status = $request->has('status');
              $Categores->save();
               return response()->json([
                   'status' => true,
                   'message' => "Categores Created successfully!",
                   "data" => $Categores
               ], 200);
           }else{
                //  $this->authorize('create',City::class);
                 $Categores =new Category();
                 $Categores->title = $request->input('title');
                 $Categores->description = $request->input('description');      
                 $Categores->status = $request->has('status');
                 // 

               $isSaved =$Categores->save();
               if($isSaved){
       
                   // هذا السشن علشان احمل معي متغير برسالة  الفلاش علشان يتم استخدامها مرة فقط 
                     session()->flash('message','Categores Created succsesfully');
                   // هذا بخليني اذا تم الحفظ يحولني على صفحة العرض 
                  // return redirect()->route('cities.index');
                   // اول ما تخلص اطبعلي الرسالة وارجع لنفس الصفحة 
                 return redirect()->back();
               }else{
                   return redirect()->back();
               }
            }
           
         
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
 
 
        return response()->view('cms.category.update',['category'=>$category]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $valedator = Validator($request->all(),[
            'title' => 'required|string|min:3|max:45',
            'description' => 'required|string|min:3|max:100',        
            'status' => 'nullable|string|in:Visible,InVisible',
        ]);
        if(auth('user-api')->check()){
           
             
              $category->title = $request->input('title');
              $category->description = $request->input('description');      
            //   $category->status = $request->has('status');
              $category->save();
               return response()->json([
                   'status' => true,
                   'message' => "Categores Update successfully!",
                   "data" => $category
               ], 200);
           }else{
                //  $this->authorize('create',City::class);
              $category->title = $request->input('title');
                 $category->description = $request->input('description');      
                 $category->status = $request->has('status');
                 // 

               $isSaved =$category->save();
               if($isSaved){
       
                      session()->flash('message','Categores Update succsesfully');
 
                 return redirect()->back();
               }else{
                   return redirect()->back();
               }
            }
           
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
   

    if(auth('user-api')->check()){
        $isDeleted =$category->delete();
        return response()->json(['message' => $isDeleted ? 'Delete Successfully' :'Delete Failed!'],   $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST );

         
     }else {
    //    $this->authorize('delete',$city);
       $isDeleted =$category->delete();
     if($isDeleted){
            return redirect()->back();
     }else{
         return redirect()->back();
     }
     }








    }
}
