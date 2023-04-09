<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\product;
use App\Models\cartorder;
use App\Models\order_details;
use App\Models\review;
use Carbon\Carbon;
use Auth;
use Pdf;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
     $users=User::all();
       $product_data= product::latest()->get();
     $orders = cartorder::where('user_id',Auth::id())->latest()->get();
     $creditcard =cartorder::where('payment_option',1)->count();
     $cashondelivary =cartorder::where('payment_option',2)->count();
        
        return view('home',compact('users','orders','creditcard','cashondelivary'));
    }


    function download_invoice($order_id){
            $data = cartorder::find($order_id);
             $order_details = order_details::where('order_id',$order_id)->get();
           $pdf = Pdf::loadView('pdf.invoice', compact('data','order_details'));

           $name = "invoice".Carbon::now().'.pdf';
           return $pdf->download($name);
    }

function give_review($order_id){
  
           $order_details = order_details::where('order_id',$order_id)->get();
   return view('customer.givereview',   compact('order_details'));
}
     function review_post(Request $request,$order_details_id){

       review::insert([

         'product_id'=>order_details::find($order_details_id)->product_id,
         'user_id'=>Auth::id(),
         'order_details_id'=>$order_details_id,
         'review'=>$request->review,
         'stars'=>$request->stars,
         'created_at'=>Carbon::now()
       ]);


   return back();
}

}
