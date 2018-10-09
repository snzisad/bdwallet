<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;

class NewsController extends Controller
{
    public function index(){
    	$news = News::first();
    	return view('adminpanel/news')->with(compact("news"));
    }

    public function saveNews(Request $request){
    	
    	$news = News::findOrFail(1);
    	$news->update($request->all());
    	$news->save();

    	return redirect()->back()->withErrors(['message' => "News Updated Successfully"]);
    }
}
