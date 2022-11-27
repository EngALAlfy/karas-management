<?php

namespace App\Http\Controllers;

use App\Models\Mekawel;
use App\Models\Tawkeel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class MekawelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $mekawels = Mekawel::all();
        return new JsonResponse(['success' => true , 'data' => $mekawels]);
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
            'phone' => 'nullable|min:10|max:11',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false , 'errors' => $validator->errors()]);
        }

        Mekawel::create($request->only('name' , 'phone'));

        return response()->json(['success' => true]);
    }


    public function getTawkeels(Mekawel $mekawel)
    {
        $mekawel = Mekawel::where('id' , $mekawel->id)->with('tawkeels')->first();
        return new JsonResponse(['success' => true , 'data' => $mekawel->tawkeels , 'data2' => $mekawel]);
    }

    public function storeTawkeel(Request $request , Mekawel $mekawel)
    {
        $validator = Validator::make($request->all(), [
            'tawkeel_id' => 'required',
            'mekawel_price_20' => 'required',
            'mekawel_price_40' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false , 'errors' => $validator->errors()]);
        }

        $uinqe = $mekawel->tawkeels()->wherePivot('tawkeel_id' ,$request->input('tawkeel_id'))->exists();

        if($uinqe == true){
            return response()->json(['success' => false , 'errors' => "التوكيل موجود بالفعل لدي المقاول"]);
        }

        $mekawel->tawkeels()->attach($request->only('tawkeel_id') , $request->only('mekawel_price_20' , 'mekawel_price_40'));

        return response()->json(['success' => true , 'data' => $uinqe]);
    }

    public function deleteTawkeel(Mekawel $mekawel , Tawkeel $tawkeel)
    {
        //
        $mekawel->tawkeels()->detach($tawkeel->id);
    }



    public function destroy(Mekawel $mekawel)
    {
        //
        $mekawel->delete();
        $mekawel->orders()->delete();
        return response()->json(['success' => true]);
    }
}
