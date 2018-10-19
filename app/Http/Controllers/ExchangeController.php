<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gateway;
use App\BalanceType;
use App\ExchangeRate;
use App\ExchangeHistory;

class ExchangeController extends Controller
{

	public function viewExchangeRate(){

		$balance_type = BalanceType::orderBy('type','asc')->get();
		$all_gateway = Gateway::orderBy('name','asc')->get();
		$rates = ExchangeRate::get();
		
		return view('adminpanel/exchangeRate')->with(compact('balance_type','all_gateway',"rates"));
	}

	public function saveExchangeRate(Request $request){
		$this->validate($request,[
			"from_id" => "required",
			"to_id" => "required",
			"from_rate" => "required",
			"to_rate" => "required",
			"to_rate_type" => "required",
			"from_rate_type" => "required",
			"minimum_transfer" => "required",
		]);
		//remove previous rate if exists
		ExchangeRate::where('to_id',$request->to_id)->where('from_id',$request->from_id)->delete();

		//insert new rate
		ExchangeRate::create($request->all());

		return redirect()->back()->withErrors([
			'message' => 'Rate updated successfully'
		]);
	}

	public function viewExchangeRequest(){
		$requests = ExchangeHistory::where('status','Processing')->get();
		
		return view('adminpanel/exchangeRequest')->with(compact('requests'));
	}

	public function sendExchangeRequest(Request $request){
		$this->validate($request,[
			"from_id" => "required",
			"send_amount" => "required",
			"to_id" => "required",
			"receive_amount" => "required",
		]);

		$exchange_id = str_random(5).date("ymdHis");

		$send_from = Gateway::where('id', $request->from_id)->first();
		$send_to = Gateway::where('id', $request->to_id)->first();

		return view('exchange/confirmOrder')->with(compact("request", "send_from",'send_to',"exchange_id"));
	}

	public function confirmExchangeRequest(Request $request){

		$this->validate($request,[
			"from_id" => "required|integer",
			"to_id" => "required|integer",
			"send_amount" => "required",
			"receive_amount" => "required",
			"user_phone" => "required",
			"user_account" => "required",
			"transaction_number" => "required",
			"status" => "required",
			"rate" => "required",
		]);


		ExchangeHistory::create($request->all());

		//change the reserve
		$to_gateway = Gateway::where('id', $request->to_id)->first();
		$curr_amount = $to_gateway->reserve-$request->receive_amount;
		Gateway::where('id', $request->to_id)->update([
			"reserve" => $curr_amount
		]);

		return redirect('track/welcome/'.$request->exchange_id);
	}

	public function trackExchange($type, $id){
		$exchange_info = ExchangeHistory::where('exchange_id',$id)->first();

		if($exchange_info){
			if($type == 'welcome'){
				$new_request = true;
				return view('exchange/track')->with(compact("exchange_info",'new_request'));
			}
			else{
				return view('exchange/track')->with(compact("exchange_info"));
			}
		}
		else{
			$error = "not found";
			return view('exchange/track')->with(compact("error"));
		}
	}

}
