<?php

namespace App\Http\Controllers;

use App\Models\Mekawel;
use App\Models\Order;
use App\Models\Tawkeel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    //

    function index(){
        if (Auth::check()) {
                return redirect('/home/orders');
        } else {
            return redirect()->route('login');
        }
    }

    function adminHome(){

        $daily_earnings = 0;
        $weekly_earnings = 0;
        $monthly_earnings = 0;

        $daily = Order::with('tawkeel' , 'mekawel.tawkeels')->where('date' ,'=' , Carbon::today())->get();
        $weekly = Order::with('tawkeel' , 'mekawel.tawkeels')->whereBetween('date' , [new Carbon("last saturday") , new Carbon("next friday")])->get();
        $monthly = Order::with('tawkeel' , 'mekawel.tawkeels')->whereMonth('date' ,'=' , Carbon::now()->month)->get();


        foreach ($daily as $key => $order) {
            foreach ($order->mekawel->tawkeels as $key => $tawkeel) {
                if($tawkeel->id == $order->tawkeel->id){
                    $mekawel_price_20 = $tawkeel->pivot->mekawel_price_20;
                    $mekawel_price_40 = $tawkeel->pivot->mekawel_price_40;

                    $price_20 = $tawkeel->price_20;
                    $price_40 = $tawkeel->price_40;

                    $count_20 = $order->count_20;
                    $count_40 = $order->count_40;

                    $sum = ($mekawel_price_20 - $price_20)* $count_20 + ($mekawel_price_40 - $price_40) * $count_40;
                    $daily_earnings += $sum;
                }
            }
        }


        foreach ($weekly as $key => $order) {
            foreach ($order->mekawel->tawkeels as $key => $tawkeel) {
                if($tawkeel->id == $order->tawkeel->id){
                    $mekawel_price_20 = $tawkeel->pivot->mekawel_price_20;
                    $mekawel_price_40 = $tawkeel->pivot->mekawel_price_40;

                    $price_20 = $tawkeel->price_20;
                    $price_40 = $tawkeel->price_40;

                    $count_20 = $order->count_20;
                    $count_40 = $order->count_40;

                    $sum = ($mekawel_price_20 - $price_20)* $count_20 + ($mekawel_price_40 - $price_40) * $count_40;
                    $weekly_earnings += $sum;
                }
            }
        }

        foreach ($monthly as $key => $order) {
            foreach ($order->mekawel->tawkeels as $key => $tawkeel) {
                if($tawkeel->id == $order->tawkeel->id){
                    $mekawel_price_20 = $tawkeel->pivot->mekawel_price_20;
                    $mekawel_price_40 = $tawkeel->pivot->mekawel_price_40;

                    $price_20 = $tawkeel->price_20;
                    $price_40 = $tawkeel->price_40;

                    $count_20 = $order->count_20;
                    $count_40 = $order->count_40;

                    $sum = ($mekawel_price_20 - $price_20)* $count_20 + ($mekawel_price_40 - $price_40) * $count_40;
                    $monthly_earnings += $sum;
                }
            }
        }


        return view('admin' , compact('daily_earnings' , 'monthly_earnings' , 'weekly_earnings'));
    }


    function search(Request $request)
    {
        if($request->input('to') && $request->input('from') && $request->has('mekawel_name')){

            $name = $request->input('mekawel_name');

            $to = $request->input('to');
            $from = $request->input('from');

            $mekawels = Mekawel::where('name' , 'LIKE' , "%{$name}%")->get();

            $first_mekawel = $mekawels->first();
            $mekawel_name = $first_mekawel ? $first_mekawel->name : "لا يوجد مقاول مطابق";

            $orders = Order::with('tawkeel' , 'mekawel.tawkeels')
            //->whereIn('mekawel_id' , $mekawels)
            ->whereBetween('date' , [$from , $to])
            ->whereIn('mekawel_id' , $mekawels)
            ->get();


            $mekawels = Mekawel::all();
            //$tawkeels = Tawkeel::all();
            $search = true;

            return view('orders.index' , compact('orders' , 'to' , 'from' , 'mekawel_name' , 'mekawels' , 'search'));
        }
    }

    function showLogin(){
        return view('login');
    }

    function login(Request $request){
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

}
