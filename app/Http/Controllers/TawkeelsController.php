<?php

namespace App\Http\Controllers;

use App\Models\Mekawel;
use App\Models\Tawkeel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TawkeelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $tawkeels = Tawkeel::all();
        return new JsonResponse(['success' => true , 'data' => $tawkeels]);
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
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:100',
            'price_40' => 'required',
            'price_20' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false , 'errors' => $validator->errors()]);
        }

        Tawkeel::create($request->only('name' , 'price_20' , 'price_40'));

        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tawkeel  $tawkeel
     * @return \Illuminate\Http\Response
     */
    public function show(Tawkeel $tawkeel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tawkeel  $tawkeel
     * @return \Illuminate\Http\Response
     */
    public function edit(Tawkeel $tawkeel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tawkeel  $tawkeel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tawkeel $tawkeel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tawkeel  $tawkeel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tawkeel $tawkeel)
    {
        //
        $tawkeel->delete();
        return response()->json(['success' => true]);
    }
}
