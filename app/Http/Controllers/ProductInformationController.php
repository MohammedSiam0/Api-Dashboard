<?php

namespace App\Http\Controllers;

use App\Models\ProductInformation;
use Illuminate\Http\Request;

class ProductInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        // in view use this code ==>    <div class="mb-3">{!! DNS2D::getBarcodeHTML("$productCode", 'QRCODE') !!}</div>
        $productCode = rand(1234567890,50);

        return view('barcode', [
            'productCode' => $productCode
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductInformation  $productInformation
     * @return \Illuminate\Http\Response
     */
    public function show(ProductInformation $productInformation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductInformation  $productInformation
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductInformation $productInformation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductInformation  $productInformation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductInformation $productInformation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductInformation  $productInformation
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductInformation $productInformation)
    {
        //
    }
}
