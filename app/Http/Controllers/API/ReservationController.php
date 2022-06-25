<?php

namespace App\Http\Controllers\API;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Price;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = Reservation::all();
        foreach ($reservations as $reservation) {
            $reservation->transportation;
            $reservation->user;
        }
        return $reservations;
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
            'user_id' => 'required|integer|exists:users,id',
            // 'transportation_id' => 'required|integer|exists:transportations,id',
            'from' => 'required|string',
            'to' => 'required|string',
            'date' => 'required|string',
            'hour' => 'required|string',
            'minute' => 'required|string',
            'Ampm' => 'required|string',
            'trucktype' => 'nullable|string',

            'payment_type' => 'nullable|string',
            'card_number' => 'nullable|string',
            'card_holder' => 'nullable|string',
            'exp_mm' => 'nullable|string',
            'exp_yy' => 'nullable|string',
            'cvv' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->all()
            ]);
        }

        $total_price = Price::where('from', $request->from)
            ->where('to', $request->to)
            ->first()->price;

        $time = date('H:i' , strtotime($request->hour . ':' . $request->minute . ' ' . $request->Ampm));

        if($request->payment_type = 'CC'){
            Credit::create([
                'card_number' => $request->card_number,
                'card_holder' => $request->card_holder,
                'exp_mm' => $request->exp_mm,
                'exp_yy' => $request->exp_yy,
                'cvv' => $request->cvv,
                'user_id' => $request->user_id
            ]);
        }

        $reservation = Reservation::create([
            'user_id' => $request->user_id,
            'transportation_id' => 1,
            'from' => $request->from,
            'to' => $request->to,
            'date' => $request->date,
            'time' => $time,
            'total_price' => $total_price,
        ]);

        $reservation['trucktype'] = $request->trucktype;

        return response()->json([
            'status' => true,
            'message' => 'Reservation created successfully',
            'data' => $reservation
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
        $reservation = Reservation::find($id);
        $reservation->transportation;
        $reservation->user;
        return $reservation;
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
            'user_id' => 'required|integer|exists:users,id',
            'transportation_id' => 'required|integer|exists:transportations,id',
            'from' => 'required|string',
            'to' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|string',
            'total_price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->all()
            ]);
        }

        $reservation = Reservation::find($id);
        $reservation->update([
            'user_id' => $request->user_id,
            'transportation_id' => $request->transportation_id,
            'from' => $request->from,
            'to' => $request->to,
            'date' => $request->date,
            'time' => $request->time,
            'total_price' => $request->total_price,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Reservation updated successfully',
            'data' => $reservation
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
        $reservation = Reservation::find($id);
        $delete = $reservation->delete();
        if ($delete) {
            return response()->json([
                'status' => true,
                'message' => 'Reservation deleted successfully',
                'data' => $reservation
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Reservation not deleted'
            ]);
        }
    }
}
