<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{

       public function __construct(){

         $this->authorizeResource(City::class,'city');

      }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // لو بدي اعمل صلاحيات علشان ما حدا يفوت عن طريق الرابط بس بشكل يدوي مش عن طريق الكنسترككتور الي فوق 
        //$this->authorize('viewAny',City::class);

            //  جيبلي كل ابيانات الي في جودل ال city 
            //  $cities = City::all();
            //  cms.cities.indexخد البيانات وديهم على صفحة ال   
            //  cities تحت مسمى ال 
            //  return response()->view('cms.cities.index',['cities'=> $cities]);
            
            // جيبلي كل ابيانات الي في جودل ال city 
            $cities =City::all();
        if(auth('user-api')->check()){
         
            return response()->json([
                'status'=>true,
                'message' => 'Success',
                'data'=>$cities
            ]);
        }else{
        // cms.cities.indexخد البيانات وديهم على صفحة ال   
        // cities تحت مسمى ال 
       return response()->view('cms.cities.index',['cities'=> $cities]);
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {

        $this->authorize('create',City::class);
        return response()->view('cms.cities.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
                'name_en' => 'required|string|min:3|max:50',
                'name_ar' => 'required|string|min:3|max:50',
                'active' => 'nullable|string|in:on',
        ]
        // لو بدي اضيف رسالة واغير الرسالة تبعت الخطا الاصلية الي في ملف الفليديشن 
        ,[
            'name_en.required'=>'Enter City english name',
            'name_ar.min'=>'City name must be at least 3 characters',
        ]);

        if(auth('user-api')->check()){
         //   $this->authorize('create',City::class);
           // $cities = City::create($request->all());
           $city =new City();
           $city->name_en = $request->input('name_en');
           $city->name_ar = $request->input('name_ar');
           $city->active = $request->has('active');
           $city->save();
            return response()->json([
                'status' => true,
                'message' => "City Created successfully!",
                "data" => $city
            ], 200);
        }else{
              $this->authorize('create',City::class);
            $city =new City();
            $city->name_en = $request->input('name_en');
            $city->name_ar = $request->input('name_ar');
            $city->active = $request->has('active');
            $isSaved =$city->save();
            if($isSaved){
    
                // هذا السشن علشان احمل معي متغير برسالة  الفلاش علشان يتم استخدامها مرة فقط 
                  session()->flash('message','City Created succsesfully');
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
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        $this->authorize('view',$city);
    

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        $this->authorize('update',$city);
         return response()->view('cms.cities.update',['city'=>$city]);
        //  cms/admin/cities/{city}/edit
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
      //  $this->authorize('update',$city);
        $request->validate([
            'name_en' => 'required|string|min:3|max:50',
            'name_ar' => 'required|string|min:3|max:50',
            'active' => 'nullable|string|in:on',
    ]
     );

    
    if(auth('user-api')->check()){
      ///  تعلم استخراج api  
     $city->update($request->all());

        return [
            "status" => 1,
            "data" => $city,
            "msg" => "city updated successfully"
        ];
    }else {
    $city->name_en = $request->input('name_en');
    $city->name_ar = $request->input('name_ar');
    $city->active = $request->has('active');
    $isSaved =$city->save();

    if($isSaved){
        return redirect()->route('cities.index');
    
    }else{
        return redirect()->back();
    }
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
      
        // $this->authorize('delete',$city);
        // $isDeleted =$city->delete();
        // return redirect()->back();
        if(auth('user-api')->check()){
            $isDeleted =$city->delete();
             return [
                 "status" => $isDeleted,
                 "msg" => " Delete successfully"
             ];
             
         }else {
           $this->authorize('delete',$city);
           $isDeleted =$city->delete();
         if($isDeleted){
                return redirect()->back();
         }else{
             return redirect()->back();
         }
         }
       }
   
 
}
