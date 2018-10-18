<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gateway;
use App\ExchangeRate;
use App\WalletExchange;
use App\Wallet;
use App\WalletDeposit;
use App\WalletWithdraw;

class WalletController extends Controller
{
    public function index(){
        $all_gateway = Gateway::orderBy('name', 'asc')->get();
        $rate = ExchangeRate::where('from_id', $all_gateway[0]->name)->where('to_id', $all_gateway[0]->name)->first();

        return view("userWallet")->with(compact("all_gateway", "rate"));
    }   

    public function getWalletInfo(Request $request){

        $this->validate($request, [
            "from" => "required",
            "to" => "required",
            "user_id" => "required",
            "_token" => "required"
        ]);


        $from = $request->from;
        $to = $request->to;
        $user_id = $request->user_id;

        $from_data = Gateway::where('name', $from)->first();
        $to_data = Gateway::where('name', $to)->first();

        $wallet = Wallet::where("user_id", $user_id)->where("wallet_id", $from)->first();

        $rate = ExchangeRate::where('from_id', $from)->where('to_id', $to)->first();

        if ($wallet != null) {
            $balance = $wallet->balance;
        } else {
            $balance = 0;
        }

        return response()->json([
            'from_data' => $from_data,
            'to_data' => $to_data,
            'rate' => $rate,
            'balance' => $balance
        ], 200);
    }

    public function walletexchange(Request $request){
        $this->validate($request, [
            'user_id' => "required|integer",
            'from_id' => "required|string",
            'to_id' => "required|string",
            'send_amount' => "required|string",
            'receive_amount' => "required|string",
            'rate' => "required|string",
        ]);
        
        $wallet = Wallet::where('user_id', $request->user_id)->where('wallet_id', $request->from_id)->first();
        
        //if walet exists
        if ($wallet != null) {
            //check wallet balance is greater than sending amount or not
            if($wallet->balance>$request->send_amount){

                //change wallet balance
                $current_balance = $wallet->balance - $request->send_amount;
                $wallet->balance = $current_balance;
                $wallet->save();

                //check receiving wallet exists or not
                $receiving_wallet = Wallet::where('user_id', $request->user_id)->where('wallet_id', $request->to_id)->first();

                if ($receiving_wallet != null) { 
                    //if wallet exists
                    $current_balance = $receiving_wallet->balance + $request->receive_amount;
                    $receiving_wallet->balance = $current_balance;
                    $receiving_wallet->save();
                }
                else{
                    //create new column in table
                    Wallet::create([
                        'user_id' => $request->user_id,
                        'wallet_id' => $request->to_id,
                        'balance' => $request->receive_amount,
                    ]);
                }

                WalletExchange::create($request->all());

                return redirect()->back()->withErrors(['message'=>'Operation Successfull']);
            }
        }

        return redirect()->back()->withErrors('Insufficient balance in your wallet');

    }

    public function walletDeposit(Request $request){
        $this->validate($request, [
            'user_id' => "required|integer",
            'wallet_id' => "required|string",
            'amount' => "required|string",
            'transaction_id' => "required|string"
        ]);
        
        WalletDeposit::create($request->all());

        return redirect()->back()->withErrors(['message'=>'Deposit amount will be added to your wallet after verification']);

    }

    public function walletWithdraw(Request $request){
        $this->validate($request, [
            'user_id' => "required|integer",
            'from_id' => "required|string",
            'to_id' => "required|string",
            'rate' => "required|string",
            'send_amount' => "required|string",
            'receive_amount' => "required|string",
            'account' => "required|string",
        ]);

        $wallet = Wallet::where('user_id', $request->user_id)->where('wallet_id', $request->from_id)->first();
        
        //if walet exists
        if ($wallet != null) {
            //check wallet balance is greater than sending amount or not
            if ($wallet->balance > $request->send_amount) {
                WalletWithdraw::create($request->all());

                return redirect()->back()->withErrors(['message' => "Balance will transfer to your account after verification"]);
            }
        }

        return redirect()->back()->withErrors('Insufficient balance in your wallet');
    }

    public function getWalletBalance(Request $request){
       

        $this->validate($request, [
            "wallet" => "required",
            "user_id" => "required",
            "_token" => "required"
        ]);


        $wallet_id = $request->wallet;
        $user_id = $request->user_id;

        $wallet = Wallet::where("user_id", $user_id)->where("wallet_id", $wallet_id)->first();
        $gateway = Gateway::where("name", $wallet_id)->first();

        if ($wallet != null) {
            $balance = $wallet["balance"] . " " . $gateway["currency"]["type"];
        } else {
            $balance = 0;
        }

        return response()->json([
            'balance' => $balance
        ], 200);
    }

}
