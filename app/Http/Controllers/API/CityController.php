<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     * 
     */
    public function index()
    {
        $cities =City::where('active',true)->latest()->paginate(10)->get();
        
        return response()->json([
            'status' => true,
            'message'=>'Success Index Cities',
            'data'=>$cities
        ]);
       
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
        ]);
        $cities = City::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "City Created successfully!",
            "data" => $cities
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        return [
            "status" => true,
            "data" =>$city,
            'message' => "Show Cities !",

        ];
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
        ]);
         $city->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "City Update successfully!",
            "data" => $city
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
       
        $city->delete();
        return [
            "status" => true,
            "data" => $city,
            "message" => "City deleted successfully"
        ];
    }
}
