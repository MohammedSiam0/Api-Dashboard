<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // جيبلي كل ابيانات الي في جودل ال city 
        $cities =City::all();
         // cms.cities.indexخد البيانات وديهم على صفحة ال   
         // cities تحت مسمى ال 
        return response()->view('cms.cities.index',['cities'=> $cities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
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
        $request->validate([
            'name_en' => 'required|string|min:3|max:50',
            'name_ar' => 'required|string|min:3|max:50',
            'active' => 'nullable|string|in:on',
    ]
     );
     ///  تعلم استخراج api  
    //  $city->update($request->all());

    //     return [
    //         "status" => 1,
    //         "data" => $city,
    //         "msg" => "Blog updated successfully"
    //     ];
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
         $isDeleted =$city->delete();
         return redirect()->back();
    }
}
