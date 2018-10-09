<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gateway;
use App\BalanceType;
use App\ExchangeRate;
use App\ExchangeHistory;

class AdminController extends Controller
{
    public function acceptExchangeRequest($id){
    	ExchangeHistory::where('exchange_id',$id)->update([
    		'status' => 'Accepted'
    	]);

    	return redirect()->back();
    }

    public function rejectExchangeRequest($id){
		ExchangeHistory::where('exchange_id',$id)->update([
    		'status' => 'Rejected'
    	]);

        $exchange_info = ExchangeHistory::where('exchange_id',$id)->first();

        //change the reserve
        $gateway = Gateway::where('name', $exchange_info->to_id)->first();
        $curr_amount = $gateway->reserve+$exchange_info->receive_amount;
        Gateway::where('name', $exchange_info->to_id)->update([
            "reserve" => $curr_amount
        ]);

    	return redirect()->back();
    }
}
