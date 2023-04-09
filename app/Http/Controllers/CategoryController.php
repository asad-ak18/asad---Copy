<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\product;
use App\Models\subCategory;
use Carbon\Carbon;
use Image;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
      public function __construct()
      {
      $this->middleware('auth');
      $this->middleware('checkrole');
        
      }

    function category(){
        $category_namee =Category::all();

  $deleted_categoryies= Category::onlyTrashed()->get();
      $subCategory=subCategory::all();
            return view('Category.category',compact('category_namee','deleted_categoryies','subCategory'));
    }


    function category_post(REQUEST $request){
           
          $random_photo_name =  str::random(20).time().".".$request->category_photo->getClientOriginalExtension();
         
           $original_category_photo=$request->category_photo->getClientOriginalName();
         $category_photo= $request->file('category_photo');
          Image::make($category_photo)->save(base_path('public/uploads/category_photo/'). $random_photo_name);



          $request->validate([
              'category_name'=> 'required|max:10|min:2|unique:categories,category_name',
          ]);

          

            $category_id=Category::insertGetId($request->except('_token','category_photo')+[
              'category_name' => $request->category_name,
                     'category_photo' => $random_photo_name,
                      'created_at' => Carbon::now(),

            ]);

            subCategory::insert([
                 'category_id'=>$category_id,
                 'sub_category_name'=>$request->sub_category_name,
                 'created_at' => Carbon::now(),
            ]);


    return back()->with('category_status','category' . $request->category_name . 'created
    successfully','subCategory_status','subCategory' . $request->sub_category_name . 'created successfully');
     }

    function Category_delete($category_id){
        //   echo $category_id;
       

       if(Category::where('id',$category_id)->exists()){

           Category::find($category_id)->delete();
           product::where('category_id',$category_id)->delete();

       }
         return back()->with('category_delete_status','category deleted  successfully');
    }

    function category_delete_all(){
    Category::whereNull('deleted_at')->delete();
     

          return back();
    }
    function category_edit($category_id){
        // echo $category_id;
      $category_id=Category::find($category_id);
        return view('Category/edit',compact('category_id'));
      
    }

    function category_edit_post(Request $request){
        //  echo ;
// echo $request->category_name;
// echo $request->category_id;
  $request->validate([
  'category_name'=> 'required|max:10|min:2|unique:categories,category_name',
  ]);
        Category::find($request->category_id)->update([
            'category_name' => $request->category_name,
        ]);
          return redirect('Category/category');
    }

    function category_restore($deleted_category_id){
        Category::onlyTrashed()->where('id',$deleted_category_id)->restore();
        product::onlyTrashed()->where('id',$deleted_category_id)->restore();
        
        return back();
    }

    function category_forcedelete($forcdeleted_category_id){
        // echo $forcdeleted_category_id;
         Category::withTrashed()->where('id',$forcdeleted_category_id)->forceDelete();
        return back();

        // Category::onlyTrashed($forcdeleted_category_id)->truncate();
        // return back();
    }

    function category_all_restore($deleted_category_id){
            Category::wherenotNull('deleted_at')->restore();
            return back();
    }
    function category_checkdelete(Request $request){

      if(isset($request->category_id)){

          foreach($request->category_id as $single_category_id){
          Category::findOrFail($single_category_id)->delete();
      }
     
        return back();
      }

        else{
            return back();
        }
       

    }

  
}
