<?php

namespace App\Http\Controllers;

use App\Models\Mekawel;
use App\Models\Order;
use App\Models\Tawkeel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $orders = Order::with('tawkeel' , 'mekawel.tawkeels')->paginate(20);
        $mekawels = Mekawel::all();
        $tawkeels = Tawkeel::all();
        return view('orders.index' , compact('orders' , 'mekawels' , 'tawkeels'));
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:100',
            'number' => 'required',
            'date' => 'required',
            'tawkeel_id' => 'required',
            'mekawel_id' => 'required',
            's_w' => 'required',
            //'count_40' => 'required',
            //'count_20' => 'required',
            //'h_t' => 'required',
            'grant' => 'required|min:2|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false , 'errors' => $validator->errors()]);
        }

        try{
            Order::create($request->all());
        }catch (\Exception $e) {
            return response()->json(['success' => false , 'errors' => $e]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
