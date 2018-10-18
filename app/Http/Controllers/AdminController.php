<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gateway;
use App\BalanceType;
use App\ExchangeRate;
use App\ExchangeHistory;
use App\WalletDeposit;
use App\Message;
use App\Wallet;
use App\WalletWithdraw;

class AdminController extends Controller
{
    public function acceptExchangeRequest($id)
    {
        ExchangeHistory::where('exchange_id', $id)->update([
            'status' => 'Accepted'
        ]);

        return redirect()->back();
    }

    public function rejectExchangeRequest($id)
    {
        ExchangeHistory::where('exchange_id', $id)->update([
            'status' => 'Rejected'
        ]);

        $exchange_info = ExchangeHistory::where('exchange_id', $id)->first();

        //change the reserve
        $gateway = Gateway::where('name', $exchange_info->to_id)->first();
        $curr_amount = $gateway->reserve + $exchange_info->receive_amount;
        Gateway::where('name', $exchange_info->to_id)->update([
            "reserve" => $curr_amount
        ]);

        return redirect()->back();
    }

    public function acceptDepositRequest($id)
    {
        $deposit = WalletDeposit::find($id);
        if ($deposit->status == "processing") {
            //check wallet exists in server or not
            $wallet = Wallet::where('user_id', $deposit->user_id)->where("wallet_id", $deposit->wallet_id)->first();

            if ($wallet != null) {
                //if exists, change the balance
                $curr_balance = $wallet->balance + $deposit->amount;
                $wallet->balance = $curr_balance;
                $wallet->save();
            } else {
                //else create the wallet
                Wallet::create([
                    'user_id' => $deposit->user_id,
                    'wallet_id' => $deposit->wallet_id,
                    'balance' => $deposit->amount
                ]);
            }
            
            // chenge the reserve
            $gateway = Gateway::where("name", $deposit->wallet_id)->first();
            $curr_reserve = $gateway->reserve + $deposit->amount;
            $gateway->reserve = $curr_reserve;
            $gateway->save();

            //change status of deposit table
            $deposit->status = "accepted";
            $deposit->save();
        }

        return redirect()->back();
    }

    public function rejectDepositRequest($id)
    {
        $deposit = WalletDeposit::find($id);
        if ($deposit->status == "processing") {
            //change status of deposit table
            $deposit->status = "rejected";
            $deposit->save();
        }

        return redirect()->back();
    }

    public function acceptWithdrawRequest($id)
    {
        $withdraw = WalletWithdraw::find($id);

        if ($withdraw->status == "processing") {
            //check wallet exists in server or not
            $wallet = Wallet::where('user_id', $withdraw->user_id)->where("wallet_id", $withdraw->from_id)->first();


            if ($wallet != null) {
                //if exists, change the wallet balance
                $curr_balance = $wallet->balance - $withdraw->send_amount;
                $wallet->balance = $curr_balance;
                $wallet->save();

                // cheng the reserve
                $gateway = Gateway::where("name", $withdraw->to_id)->first();
                $curr_reserve = $gateway->reserve - $withdraw->receive_amount;
                $gateway->reserve = $curr_reserve;
                $gateway->save();
            }

            //change status of deposit table
            $withdraw->status = "accepted";
            $withdraw->save();
        }

        return redirect()->back();
    }


    public function rejectWithdrawRequest($id)
    {
        $withdraw = WalletWithdraw::find($id);

        if ($withdraw->status == "processing") {
            //change status of deposit table
            $withdraw->status = "rejected";
            $withdraw->save();
        }

        return redirect()->back();
    }

    public function viewDepositRequest()
    {
        $requests = WalletDeposit::where("status", "processing")->orderBy("id", "asc")->get();
        return view("adminpanel.depositRequest")->with(compact("requests"));
    }

    public function viewWithdrawRequest()
    {
        $requests = WalletWithdraw::where("status", "processing")->orderBy("id", "asc")->get();
        return view("adminpanel.withdrawRequest")->with(compact("requests"));
    }

    public function viewuserMessage()
    {
        $messages = Message::get();
        return view("adminpanel.userMessage")->with(compact("messages"));
    }

}
