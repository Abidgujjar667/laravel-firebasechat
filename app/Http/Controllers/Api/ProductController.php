<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::all();
        return $this->sendResponse($products,'Retrieve Successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->all();
        $validate=Validator::make($data,[
            'name'=>'required|max:100',
            'detail'=>'required|max:255'
        ]);

        if ($validate->fails()){
            return $this->sendError('Please enter correct data',$validate->errors());
        }
        $result=Product::create($data);
        return $this->sendResponse($result,'Data Inserted');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product=Product::find($id);
        if (!$product){
            return $this->sendError('Data not found',[null]);
        }
        return $this->sendResponse($product,'Data Retrieved');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $result=$product->update($request->all());
        return $this->sendResponse($product,'Data updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return $this->sendResponse('','Data Deleted');
    }
}
