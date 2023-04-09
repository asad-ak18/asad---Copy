<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\product;
use App\Models\Contact;
use App\Models\coupon;
use App\Models\faq;
use App\Models\cart;
use App\Models\country;
use App\Models\city;
use App\Models\cartorder;
use App\Models\order_details;
use App\Models\review;
use carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\Message;
use Hash;
use Auth;
use DB;



class FrontendController extends Controller
{
        public function tohoney_home(){
          

       $raw_val = order_details::select('product_id', DB::raw('count(*) as total'))
          ->groupBy('product_id')
          ->get();
           $collection =collect($raw_val);
        $sorted_best_seller = $collection->sortByDesc('total')->take(2);
         $category_namee =Category::all();
           $product_data= product::latest()->get();
      
         return view('welcome',compact('category_namee','product_data','sorted_best_seller'));
      
        }

        function contact(){
        return view('contact');
        }
        function contact_post(Request $request){
      
             Mail::to('kasad5303@gmail.com')->send(new Message($request->all()));

              return back();
            }
    //  Contact::insert($request->except('_token')+[
    //  'created_at'=>Carbon::now(),
    //  ]);
    //        return back();
        


        function about(){
        return view('about');
        }

        function shop(){
          $all_products=product::inRandomOrder()->get();
         // $all_products=product::all();
         $category_name =Category::all();
        return view('shop',compact('all_products','category_name'));
        }

        function productdetail($product_id){
                    $product_category_id= product::findOrFail($product_id)->category_id;
                        $product_info= product::findOrFail($product_id);
           $related_product =product::where('category_id',$product_category_id)->where('id','!=',$product_id)->get();
          // $related_product =product::where('category_id',$product_category_id)->get();
                   $category_namee =Category::all();
          $faq_info=faq::all();

          $review=review::where('product_id',$product_id)->get();
if(review::where('product_id',$product_id)->exists()){
 $ovarall_review=review::where('product_id',$product_id)->sum('stars')/ review::where('product_id',$product_id)->count();
}
else{
     $ovarall_review = 0;
}
       return
       view('productdetail',compact('product_info','category_namee','faq_info','related_product','review','ovarall_review'));
        }

        
        // function cart_coupon($coupon_name){
        //       if($coupon_name=="coupon nai"){
        //       $coupon_discount =0;
        //       }
        //       else{
        //       $coupon_name;
        //       if(coupon::where('coupon_name',$coupon_name)->exists()){

        //       if(Carbon::now()->format('Y-m-d') >coupon::where('coupon_name',$coupon_name)->first()->expire_date){
        //       echo "expire hoe gese";
        //       }
        //       else{
        //       if(coupon::where('coupon_name',$coupon_name)->first()->uses_limit > 0){
        //     echo   $coupon_discount= coupon::where('coupon_name',$coupon_name)->first()->discount_amount;
          
        //       }
        //       else{
        //       echo "limit ses";
        //       }
        //       }
        //       }
        //       else{
        //        "invalid coupon name";
        //       }
        //       }
        //       return view('cart',[
        //       'cart'=>cart::where('ip_address',request()->ip())->get(),
        //       'coupon_discount'=>$coupon_discount,
        //       ]);
        //   //  return view('cart');
        // }



         

        function cart($coupon_name=""){
         
            $coupon_discount =0;
          if($coupon_name == ""){
            $coupon_discount =0;
          }
          else{
            //  $coupon_name;
            if(coupon::where('coupon_name',$coupon_name)->exists()){
               
                if(Carbon::now()->format('Y-m-d') > coupon::where('coupon_name',$coupon_name)->first()->expire_date){
                return back()->with('coupon_err','expire hoe gese');
                }
                else{
                   if(coupon::where('coupon_name',$coupon_name)->first()->uses_limit > 0){
                     $coupon_discount= coupon::where('coupon_name',$coupon_name)->first()->discount_amount;
                   }
                   else{
                      
                        return back()->with('coupon_err','limit ses');

                   }
                }
            }
            else{
                
                   return back()->with('coupon_err','invalid coupon name');
                 

            }
          }
        return view('cart',[
            'cart'=>cart::where('ip_address',request()->ip())->get(),
            'coupon_name'=>$coupon_name,
            'coupon_discount'=>$coupon_discount,
        ]);
        }



        function checkout(){
    
        $countries =   country::select('id','name')->get();
        return view('checkout',compact('countries'));
        }
        function wishlist(){
        return view('wishlist');
        }
        function blog(){
        return view('blog');
        }
        function blogdetail(){
        return view('blogdetail');
        }
        function faq(){
        return view('faq');
        }

        function categorywise($category_id){
         $product_data = product::where('category_id',$category_id)->get();
      $category_name= Category::find($category_id)->category_name;
           return view('categorywiseshop',compact('product_data','category_name'));
        }

        function update_cart(Request $request){
          // print_r($request->all());
foreach($request->quantity as $cart_id=>$quantity){
     echo $cart_id;
     echo $quantity;

     cart::find($cart_id)->update([
          'quantity'=>$quantity,
     ]);
}
return back();




        }

        function customer_register(){
            return view('customer_signup');
        }


        function customer_register_post(Request $request){
        
          User::insert([
              'name'=>$request->name,
              'email'=>$request->email,
              'password'=>bcrypt($request->password),
               'role'=>2,
               'created_at'=>Carbon::now(),
               'updated_at'=>Carbon::now(),
          ]);
          return back();
        }

        function customer_signin(){
           return view('customer_signin');
        }

        function customer_signin_post(Request $request){
         
          // echo User::($request->name)->exists();
          

          if(User::where('email',$request->email)->exists()){
            $db_password= User::where('email',$request->email)->first()->password;
          
            if(Hash::check($request->password, $db_password)){
                  if(Auth::attempt($request->except('_token'))){
                      return redirect()->intended('home');
                  }
            }
            else{
              return back()->with('cus_log_err','your email or password is wrong!');
               
            }
          }
          else{
         
           return back()->with('cus_log_err','Email not found');
          }

          // User::insert([
          //   'name'=>$request->name,
          //   'email'=>$request->email,
          //   'password'=>bcrypt($request->password),
          //   'role'=>2,
          //   'created_at'=>Carbon::now(),
          //   'updated_at'=>Carbon::now(),
          // ]);
           
        }

        function get_city_list(Request $request){
            // 
            $str_to_send = "";
            foreach(city::where('country_id',$request->country_id)->select('id','name')->get() as $city){
              //  echo ;
              //  echo  $city->id;

                $str_to_send = $str_to_send."<option value='$city->id'> $city->name</option>";
            }
            echo $str_to_send;
         
          // echo ;
          return back();
        }
     
        function checkout_post(Request $request){
            //  print_r($request->all());
            if($request->payment_option ==1){
                return redirect ('online/payment');
            }
            else{
              // echo "Cash on delivery";
              $order_id =cartorder::insertGetId( $request->except('_token') +[
                'user_id'=>Auth::id(),
              'payment_status'=>1,
              'discount'=>session('session_coupon_discount'),
              'subtotal'=>session('session_subtotal'),
              'total'=>session('session_total'),
              'created_at'=>Carbon::now(),
              ]);
             

           $carts= cart::where('ip_address',request()->ip())->select('id','product_id','quantity')->get();
           foreach($carts as $cart){
              // echo $cart->product_id;
              // echo $cart->quantity;
              order_details::insert([
                 'order_id'=>$order_id,
                 'product_id'=>$cart->product_id,
                 'quantity'=>$cart->quantity,
                 'created_at'=>Carbon::now(),
              ]);
              product::find($cart->product_id)->decrement('product_quantity',$cart->quantity);
              cart::find($cart->id)->delete();
           }
           return redirect('home');
            }
        }


      function search(){

      $search_str="%".$_GET['s']."%";
              $all_products=product::inRandomOrder()->get();
         
             $search_product =  product::where('product_name','LIKE',$search_str)->get();
            return view('search',compact('search_product'));
      }






}
