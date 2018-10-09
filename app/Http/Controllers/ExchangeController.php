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


			// $rates = ExchangeRate::join('gateway','exchange_rate.from_id','gateway.id')
			// ->join('gateway','exchange_rate.to_id','gateway.id')
			// ->join('balance_type','exchange_rate.from_rate_type','balance_type.id')
			// ->join('balance_type','exchange_rate.to_rate_type','balance_type.id')
			// ->get();
		
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

		$send_from = Gateway::where('name', $request->from_id)->join('balance_type','gateway.type','balance_type.id')->first();
		$send_to = Gateway::where('name', $request->to_id)->join('balance_type','gateway.type','balance_type.id')->first();

		return view('exchange/confirmOrder')->with(compact("request", "send_from",'send_to',"exchange_id"));
	}

	public function confirmExchangeRequest(Request $request){
		$this->validate($request,[
			"from_id" => "required",
			"to_id" => "required",
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
		$to_gateway = Gateway::where('name', $request->to_id)->first();
		$curr_amount = $to_gateway->reserve-$request->receive_amount;
		Gateway::where('name', $request->to_id)->update([
			"reserve" => $curr_amount
		]);

		return redirect('track/welcome/'.$request->exchange_id);
	}

	public function trackExchange($type, $id){
		$exchange_info = ExchangeHistory::where('exchange_id',$id)->first();

		if($exchange_info){
			$send_from_data = Gateway::where('name', $exchange_info->from_id)->join('balance_type','gateway.type','balance_type.id')->first();
			$send_to_data = Gateway::where('name', $exchange_info->to_id)->join('balance_type','gateway.type','balance_type.id')->first();
			
			if($type == 'welcome'){
				$new_request = true;
				return view('exchange/track')->with(compact("exchange_info",'send_from_data','send_to_data','new_request'));
			}
			else{
				return view('exchange/track')->with(compact("exchange_info",'send_from_data','send_to_data'));
			}
		}
		else{
			$error = "not found";
			return view('exchange/track')->with(compact("error"));
		}
	}

}
