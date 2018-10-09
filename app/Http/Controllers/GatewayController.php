<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gateway;
use App\BalanceType;
use Illuminate\Support\Facades\Storage;

class GatewayController extends Controller
{
     public function index(){
    	$balance_type = BalanceType::orderby('type','asc')->get();
    	$all_gateway = Gateway::orderBy('name','asc')->join('balance_type', 'gateway.type','balance_type.id')->select('gateway.*', 'balance_type.type as type')->get();

    	return view('adminpanel/gateway')->with(compact("balance_type","all_gateway"));
    }

    public function addGateway(Request $request){
    	$this->validate($request, [
    		'name' => 'required',
    		'reserve' => 'required|integer',
            'type' => 'required|integer',
    		'account' => 'required',
    		'icon' => 'required| mimes: jpg,jpeg,png',
    	]);

    	$gateway = Gateway::create($request->all());
    	$icon = $request->icon;
    	$icon_name = $gateway->id.".".$icon->extension();

    	$icon->storeAs('public/icon',$icon_name);

        Gateway::where("id", $gateway->id)->update([
            "icon" => $icon_name
        ]);

    	return redirect()->back()->withErrors(['message' => "Gateway added Successfully"]);
    }

    public function editGateway(Request $request){
    	$this->validate($request, [
    		'id' => 'required|integer',
    		'name' => 'required',
    		'reserve' => 'required|integer',
    		'type' => 'required|integer',
            'account' => 'required',
    		'icon' => 'mimes: jpg,jpeg,png',
    	]);

    	$gateway = Gateway::findOrFail($request->id);

    	if($request->icon){
	    	$icon = $request->icon;
	    	$icon_name = $gateway->id.".".$icon->extension();

	    	Storage::delete('public/icon/'.$gateway->icon);  
	    	$icon->storeAs('public/icon',$icon_name);
    	
	    	$gateway->update($request->all());
	    	$gateway->save();

	        Gateway::where("id", $gateway->id)->update([
	            "icon" => $icon_name
	        ]);
    	}
    	else{
	    	$gateway->update($request->all());
	    	$gateway->save();
    	}

    	return redirect()->back()->withErrors(['message' => "Gateway updated Successfully"]);
    }
    public function removeGateway($id){

    	$gateway = Gateway::findOrFail($id);

    	Storage::delete('public/icon/'.$gateway->icon); 
    	$gateway->delete();

    	return redirect()->back()->withErrors(['message' => "Gateway removed Successfully"]);
    }
}
