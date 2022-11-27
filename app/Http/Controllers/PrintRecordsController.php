<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PrintRecord;
use App\Models\PrintDate;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class PrintRecordsController extends Controller
{

    function index(PrintDate $printDate)
    {
        $records = PrintRecord::where('print_date_id' , $printDate->id)->get();
        return view('orders.print-records' , compact('records'));
    }
    

    function dates()
    {
        $records = PrintDate::all();
        return new JsonResponse(['success' => true , 'data' => $records]);
    }

    //
    function store(Request $request){
        $validator = Validator::make($request->all(), [
            //'name' => 'required|min:2|max:100',
            //'number' => 'required',
            //'date' => 'required',
            //'tawkeel_id' => 'required',
            'rows' => 'required',
            //'s_w' => 'required',
            //'count_40' => 'required',
            //'count_20' => 'required',
            //'sum' => 'required',
            //'grant' => 'required|min:2|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false , 'errors' => $validator->errors()]);
        }

        $records = $request->input('rows');

        $date = now();

        $printDate = PrintDate::create(['date' => $date]);

        foreach ($records as $key => $value) {
            $value['print_date_id'] = $printDate->id;
            PrintRecord::create($value);       
        }

        return response()->json(['success' => true]);
    }
}
