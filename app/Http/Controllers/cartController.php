<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\cart;
use App\Models\product;
use Carbon\Carbon;

class cartController extends Controller
{
    function cart_post(Request $request, $product_id){
        // echo $product_id;
        //  print_r($request->quantity);
      

       if($request->quantity > product::find($product_id)->product_quantity ){
          return back()->with('error','stoke not available');
       }
       
      
       if(cart::where('product_id',$product_id)->where('ip_address',request()->ip())->exists()){
        cart::where('product_id',$product_id)->where('ip_address',request()->ip())->increment('quantity',$request->quantity);
       }
       else{
               cart::insert([
               'product_id'=>$request->product_id,
               'quantity'=>$request->quantity,
               'ip_address'=> request()->ip(),
               'created_at'=>Carbon::now(),
               ]);
       }
   
 
       return back();
    }


    function cart_delete($cart_id){
         cart::find($cart_id)->delete();
         return back();
        }
}
