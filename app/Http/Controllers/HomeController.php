<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gateway;
use App\News;
use App\ExchangeHistory;
use App\ExchangeRate;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_gateway = Gateway::orderBy('name','asc')->join('balance_type','gateway.type','balance_type.id')->get();
        $rate = ExchangeRate::where('from_id', $all_gateway[0]->name)->where('to_id', $all_gateway[0]->name)->first();
        $exchange_history = ExchangeHistory::orderBy('exchange_history.id','desc')->join('gateway', 'exchange_history.from_id', 'gateway.name')->join('balance_type', 'gateway.type', 'balance_type.id')->get();
        $news = News::first();

        // $exchange_history = ExchangeHistory::limit(10);


        return view('welcome')->with(compact("all_gateway","rate","exchange_history","news"));
    }

    public function getExchangeInfo(Request $request){
        $this->validate($request, [
            "from" => "required",
            "to" => "required",
            "_token" => "required"
        ]);
        $from = $request->from;
        $to = $request->to;

        $from_data = Gateway::where('name', $from)->first();
        $to_data = Gateway::where('name', $to)->join('balance_type','gateway.type','balance_type.id')->first();

        $rate = ExchangeRate::where('from_id',$from)->where('to_id',$to)->first();


        return response()->json([
            'from_data' => $from_data,
            'to_data' => $to_data,
            'rate' => $rate
        ], 200);
    }

    public function trackExchange(Request $request){
        $this->validate($request, [
            "exchange_id" => "required"
        ]);

        return redirect('track/0/'.$request->exchange_id); 
    }
}
