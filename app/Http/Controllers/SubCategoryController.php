<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\subCategory;
use Carbon\Carbon;

class SubCategoryController extends Controller
{
   public function __construct()
   {
   $this->middleware('auth');
   $this->middleware('checkrole');

   }



   function SubCategory(){
    $Category_info=Category::all();
    $subCategory=subCategory::all();
      return view('subCategory/SubCategory',compact('Category_info','subCategory'));
   }
   function sub_Category_post(Request $request){
      
         subCategory::insert([
             'category_id'=> $request->category_id,
             'sub_category_name'=> $request->sub_category_name,
             'created_at'=>Carbon::now(),
         ]);
         return back();
   }
}
