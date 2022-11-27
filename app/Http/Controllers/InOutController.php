<?php

namespace App\Http\Controllers;

use App\Models\Incoming;
use App\Models\IncomingDate;
use App\Models\IncomingRecord;
use App\Models\OutgoingDate;
use App\Models\Outgoing;
use App\Models\OutgoingRecord;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InOutController extends Controller
{
    //
    function outgoings()
    {
        $outgoings = Outgoing::all();
        return response()->json(['success' => true , 'data' => $outgoings]);
    }


    function incomings()
    {
        $incomings = Incoming::all();
        return response()->json(['success' => true , 'data' => $incomings]);
    }

    function storeIncoming(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:100',
            'paid' => 'required',
            'date' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false , 'errors' => $validator->errors()]);
        }

        try{
            Incoming::create($request->all());
        }catch (\Exception $e) {
            return response()->json(['success' => false , 'errors' => $e]);
        }

        return response()->json(['success' => true]);
    }

    function storeOutgoing(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|min:2|max:100',
            'price' => 'required',
            'date' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false , 'errors' => $validator->errors()]);
        }

        try{
            Outgoing::create($request->all());
        }catch (\Exception $e) {
            return response()->json(['success' => false , 'errors' => $e]);
        }

        return response()->json(['success' => true]);
    }





    //// records

    function outgoingRecords(OutgoingDate $outgoingDate)
    {
        $records = OutgoingRecord::where('outgoing_date_id' , $outgoingDate->id)->get();
        return new JsonResponse(['success' => true , 'data' => $records]);
    }


    function outgoingDates()
    {
        $records = OutgoingDate::all();
        return new JsonResponse(['success' => true , 'data' => $records]);
    }

    //
    function storeOutgingRecords(Request $request){
        $validator = Validator::make($request->all(), [

            'rows' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false , 'errors' => $validator->errors()]);
        }

        $records = $request->input('rows');

        $date = now();

        $outgoingDate = OutgoingDate::create(['date' => $date]);

        foreach ($records as $key => $value) {
            $value['outgoing_date_id'] = $outgoingDate->id;
            OutgoingRecord::create($value);
        }

        return response()->json(['success' => true]);
    }

    ////////
    function incomingRecords(IncomingDate $incomingDate)
    {
        $records = IncomingRecord::where('incoming_date_id' , $incomingDate->id)->get();
        return new JsonResponse(['success' => true , 'data' => $records]);
    }


    function incomingDates()
    {
        $records = IncomingDate::all();
        return new JsonResponse(['success' => true , 'data' => $records]);
    }

    //
    function storeIncomingRecords(Request $request){
        $validator = Validator::make($request->all(), [

            'rows' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false , 'errors' => $validator->errors()]);
        }

        $records = $request->input('rows');

        $date = now();

        $incomingDate = IncomingDate::create(['date' => $date]);

        foreach ($records as $key => $value) {
            $value['incoming_date_id'] = $incomingDate->id;
            IncomingRecord::create($value);
        }

        return response()->json(['success' => true]);
    }


    function deleteOutgoings()
    {
        $records = Outgoing::all();

        $date = now();

        $outgoingDate = OutgoingDate::create(['date' => $date]);

        foreach ($records->toArray() as $key => $value) {
            $value['outgoing_date_id'] = $outgoingDate->id;
            OutgoingRecord::create($value);
        }

        Outgoing::truncate();

        return response()->json(['success' => true]);
    }

    function deleteIncomings()
    {
        $records = Incoming::all();

        $date = now();

        $incomingDate = IncomingDate::create(['date' => $date]);

        foreach ($records->toArray() as $key => $value) {
            $value['incoming_date_id'] = $incomingDate->id;
            IncomingRecord::create($value);
        }

        Incoming::truncate();

        return response()->json(['success' => true]);
    }
}
