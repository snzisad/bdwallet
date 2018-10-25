<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;

class NewsController extends Controller
{
    public function index(){
    	$news = News::where("id",1)->first();
    	$notice = News::where("id", 2)->first();
    	return view('adminpanel/news')->with(compact("news", "notice"));
    }

    public function saveNews(Request $request){
    	$this->validate($request, [
			"text" => "required",
			"notice" => "required",
		]);

		News::where("id", 1)->update([
			"text" => $request->text
		]);
		
		News::where("id", 2)->update([
			"text" => $request->notice
		]);

    	return redirect()->back()->withErrors(['message' => "News Updated Successfully"]);
    }
}
