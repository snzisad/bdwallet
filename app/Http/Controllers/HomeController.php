<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gateway;
use App\News;
use App\ExchangeHistory;
use App\ExchangeRate;
use App\Wallet;
use App\Message;
use App\Reviews;

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
        $all_gateway = Gateway::orderBy('name','asc')->get();
        $rate = ExchangeRate::where('from_id', $all_gateway[0]->id)->where('to_id', $all_gateway[0]->id)->first();
        $exchange_history = ExchangeHistory::orderBy('exchange_history.id','desc')->take(10)->get();
        $news = News::where("id", "1")->first();
        $notice = News::where("id","2")->first();
        $reviews = Reviews::orderBy('id', "desc")->take(10)->get();

        return view('welcome')->with(compact("all_gateway","rate","exchange_history","news", "reviews","notice"));
    }

    public function getExchangeInfo(Request $request){
        $this->validate($request, [
            "from" => "required|integer",
            "to" => "required|integer",
            "_token" => "required"
        ]);
        $from = $request->from;
        $to = $request->to;

        $from_data = Gateway::where('id', $from)->first();
        $to_data = Gateway::where('id', $to)->first();
        $rate = ExchangeRate::where('from_id', $from)->where('to_id', $to)->first();


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

    public function sendMessage(Request $request){
        $this->validate($request, [
            "name" => "required",
            "email" => "required",
            "email" => "required",
        ]);

        Message::create($request->all());

        return redirect()->back()->withErrors(["message"=>"Thanks for your message. We'll reply you soon"]); 
    }

    public function viewAllReview(){
        $reviews = Reviews::orderBy('id', "desc")->get();

        return view('userReview')->with(compact("reviews"));
    }
}
