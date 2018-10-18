<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExchangeHistory;
use App\Reviews;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class ProfileController extends Controller
{
    public function index(){
        $user_id = Auth::user()->id;
        $exchange_histories = ExchangeHistory::where('user_id', $user_id)->orderBy("id","desc")->get();
        $review = Reviews::where('user_id', $user_id)->first();

        return view("userProfile")->with(compact("exchange_histories", "review"));
    }

    public function saveReview(Request $request){
        $this->validate($request, [
            'status' => "required",
            'comment' => "required",
        ]);

        $user_id = Auth::user()->id;

        $review = Reviews::where('user_id', $user_id)->first();

        if($review != null){
            $review->update($request->all());
            $review->save();
        }
        else{
            Reviews::create($request->all());
        }

        return redirect()->back()->withErrors([
            "message" => "Review added successfully"
        ]);
    }

    public function changePassword(Request $request){
        $this->validate($request, [
            'current_password' => "required",
            'password' => "required|string|min:6|confirmed",
        ]);

        $user = User::find(Auth::user()->id);

        if(Hash::check($request->current_password, $user->password)){
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->back()->withErrors([
                "message" => "Password updated successfully"
            ]);
        }

        return redirect()->back()->withErrors("Incorrect password");
    }


}
