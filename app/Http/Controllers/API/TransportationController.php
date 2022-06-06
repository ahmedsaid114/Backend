<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Transportation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TransportationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_transportation = Transportation::all();
        return $all_transportation;
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
            'name' => 'required|string',
            'type' => 'required|string',
            'price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->all()
            ]);
        }

        $transportation = Transportation::create([
            'name' => $request->name,
            'type' => $request->type,
            'price' => $request->price,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Transportation created successfully',
            'data' => $transportation
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
        $transportation = Transportation::find($id);
        return $transportation;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request , $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'type' => 'required|string',
            'price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->all()
            ]);
        }

        $transportation = Transportation::find($id);
        $transportation->update([
            'name' => $request->name,
            'type' => $request->type,
            'price' => $request->price,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Transportation updated successfully',
            'data' => $transportation
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
        $transportation = Transportation::find($id);
        $delete = $transportation->delete();
        if ($delete) {
            return response()->json([
                'status' => true,
                'message' => 'Transportation deleted successfully',
                'data' => $transportation
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Transportation not deleted',
            ]);
        }
    }
}
