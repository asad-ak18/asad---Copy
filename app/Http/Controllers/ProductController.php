<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\product;
use App\Models\Featured_photo;
use App\Models\subCategory;
use Carbon\Carbon;
use Image,Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
     public function __construct()
     {
     $this->middleware('auth');
     $this->middleware('checkrole');

     }

    function product(){
        $product_data= product::where('user_id', Auth::id())->get();
       $category_info = Category::all();
     $subCategory_info = subCategory::all();

       $product_trashed = product::onlyTrashed()->get();
         return view('Product/product',compact('product_data','category_info','product_trashed','subCategory_info'));
    }

    function product_post(Request $request ){
         //  print_r($request->file('featured_product_photo'));
         // die();
         // print_r($request->all());

                     $product_photo_name= Str::random(10).time().".".$request->product_photo->getClientOriginalExtension();

                       $product_photo = $request->file('product_photo');
                       Image::make($product_photo)->save(base_path('public/uploads/products_photo/').$product_photo_name,30);
      
     //   $product_id=product::insertGetId()([
     //    'user_id'=>Auth::id(),
     //  'product_photo'=>$product_photo_name,
     //  'created_at'=>Carbon::now(),
     //  ]);
      $product_id= product::insertGetId($request->except('_token','product_photo',"featured_product_photo")+[
       'user_id'=>Auth::id(),
       'category_id'=>$request->category_id,
       'product_name'=>$request->product_name,
       'product_price'=>$request->product_price,
       'product_quantity'=>$request->product_quantity,
       'product_short_description'=>$request->product_short_description,
       'product_long_discription'=>$request->product_long_discription,
       'product_alert_quantity'=>$request->product_alert_quantity,
      'product_photo'=>$product_photo_name,
      'created_at'=>Carbon::now(),
      ]);
      
if($request->hasfile('featured_product_photo')){

         foreach($request->file('featured_product_photo') as $featured_product_photos){
              
              
     $product_photo_name= Str::random(10).time().".".$featured_product_photos->getClientOriginalExtension();
              
              $product_photo = $featured_product_photos;
              Image::make($product_photo)->save(base_path('public/uploads/products_featured/').$product_photo_name,30);
          }
     }
          
         
       Featured_photo::insert([
          'product_id'=>$product_id,
          'featured_photos_name'=>$product_photo_name,
          'created_at'=>Carbon::now(),
     ]);

    
   


        return back();

    }



    function product_delete($product_id){


            if(product::where('id',$product_id)->exists()){

            product::find($product_id)->delete();
            }
            return back()->with('product_delete_status','product deleted successfully');
        
    }

    
   function product_edit($product_id){
       $product_id = product::find($product_id);
        $categories =Category::all();
        return view('Product/product_edit',compact('product_id','categories'));
   }
  
     function product_edit_post(Request $request, $product_id){
          //  print_r($request->product_id);
    
         
          if($request->hasfile('product_new_photo')){
                "ase";
                product::find($product_id)->product_photo;
               //   delete old photo
               $old_photo_path= base_path('public/uploads/products_photo/').product::find($product_id)->product_photo;
                unlink($old_photo_path);
          }
               //  upload new photo
          
         

           $product_photo_name= Str::random(10).time().".". $request->product_new_photo->getClientOriginalExtension();


           $product_photo = $request->file('product_new_photo');
            Image::make($product_photo)->save(base_path('public/uploads/products_photo/').$product_photo_name,30);
           product::findOrFail($request->product_id)->update([
          //  'product_name' => $request->product_name,
           'product_photo'=>$product_photo_name,
           ]);
         
           product::find($product_id)->update($request->except('_token'));
           return redirect('Product/product');
     }
     function product_all_delete(){
          
            product::whereNull('deleted_at')->delete();
            return back();
     }
     function product_restore($product_id){
          // echo  $product_id;
        product::onlyTrashed()->where('id',$product_id)->restore();
          return back();
     }
     function product_all_restore($product_id){
          product::withTrashed()->wherenotNull('deleted_at')->restore();
          return back();
     }

     function product_forcedelete($force_delete_product_id){
          product::withTrashed()->where('id',$force_delete_product_id)->forceDelete();
        return back();
     }



}
