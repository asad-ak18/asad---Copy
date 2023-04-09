<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\web_s;

class WebSController extends Controller
{
    function web_s(){
   $web_s_info =   web_s::all();
      return view('web_s',compact('web_s_info'));
    }

    function settings_post(Request $request){
      foreach($request->except('_token') as $key=>$value){
        
        web_s::where('settings_name', $key)->update([
              'settings_value'=>$value,
             
            ]);
          }
          return back();
      
      
      
    }
}
