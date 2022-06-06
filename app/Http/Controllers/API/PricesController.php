<?php

namespace App\Http\Controllers\API;

use App\Models\Price;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PricesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prices = Price::all();
        return $prices;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'from' => 'required|string',
            'to' => 'required|string',
            'price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->all()
            ]);
        }

        $price = Price::create([
            'from' => $request->from,
            'to' => $request->to,
            'price' => $request->price,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Price created successfully',
            'data' => $price
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $price = Price::find($id);
        return $price;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'from' => 'required|string',
            'to' => 'required|string',
            'price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->all()
            ]);
        }

        $price = Price::find($id);
        $price->update([
            'from' => $request->from,
            'to' => $request->to,
            'price' => $request->price,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Price updated successfully',
            'data' => $price
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $price = Price::find($id);
        $delete = $price->delete();
        if($delete){
            return response()->json([
                'status' => true,
                'message' => 'Price deleted successfully',
                'data' => $price
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Price not deleted',
            ]);
        }
    }
}
