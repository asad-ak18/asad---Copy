<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\faq;
use App\Models\product;
use App\Models\productdetail_faq;


use Carbon\Carbon;

class FaqController extends Controller{
    
    function faq_form(){

        return view('faq_form');
    }
    function faq_form_post(Request $request){
         $faq_info = faq::all();
         
         faq::insert($request->except('_token')+[
                 'created_at'=>Carbon::now(),
                ]);
                return view('faq',compact('faq_info'));
           
    }

    function productdetail_faq($product_id){
              $product_info= product::find($product_id);
            
            //   return view('productdetail');
    }

    function productdetail_faq_post(Request $request){
    //   print_r($request->all()) ;
       $faq_info=productdetail_faq::all();
       
         productdetail_faq::insert($request->except('_token')+[
            'created_at'=> Carbon::now(),
        ]);
        //  return view('productdetail',compact('faq_info'));
    }


}
