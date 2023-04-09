@extends('layouts.starlight')

@section('title')
     product home
@endsection
@section('Product')
     active
@endsection
@section('breadcrumb')
       <nav class="breadcrumb sl-breadcrumb">
        <a href="{{url('home')}}" class="breadcrumb-item">Dashboard</a>
        <span class="breadcrumb-item active">product</span>
      </nav>
@endsection



@section('content')
<div class="container">
  

       

    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card mb-3" >
  <div class="card-header text-white bg-primary ">
       <div class="row">
        <div class="col-lg-9">product list</div>
       <div class="col-lg-3"><a href="{{route('product_all_delete')}}" class="btn btn-warning">delete all</a></div>
          
       </div>

  </div>
  <div class="card-body">
        <table class="table">
  <thead>
    <tr>
      <th scope="col">slno</th>
      <th scope="col">id</th>
      {{-- <th scope="col">Category name</th> --}}
      <th scope="col">product name</th>
      <th scope="col">product photo</th>
      <th scope="col">product price</th>
      <th scope="col">product quantity</th>
      <th scope="col">short description</th>
      <th scope="col">long description</th>
      <th scope="col">added by</th>
      <th scope="col">created_at</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($product_data as $product_dataa) 
  <tr>
  <th scope="row">{{$loop->index +1}}</th>
  <td>{{$product_dataa->id}}</td>
  {{-- {{App\Models\User::find($product_dataa->user_id)->category_name}} --}}
    {{-- <td>{{App\Models\Category::find($product_dataa->category_id)->category_name}}</td> --}}
  {{-- <td>{{App\Models\Category::find($product_dataa->id)->category_name}}</td> --}}
  {{-- <td>{{$product_dataa->category_name}}</td> --}}
  <td>{{$product_dataa->product_name}}</td>
  <td>{{$product_dataa->product_photo}}</td>
  {{-- <td><img src="{{asset('uploads/products_photo')}}/{{$product_dataa->product_photo}}" alt=""></td> --}}
  <td>{{$product_dataa->product_price}}</td>
  <td>{{$product_dataa->product_quantity}}</td>
  <td>{{$product_dataa->product_short_description}}</td>
  <td>{{$product_dataa->product_long_discription}}</td>
  <td>{{$product_dataa->product_alert_quantity}}</td>
  <td>
       {{App\Models\User::find($product_dataa->user_id)->name}}
  </td>
  <td>{{$product_dataa->created_at}}</td>
  <td>
     <a href="{{route('product_edit',$product_dataa->id)}}" class="btn btn-success">edit</a> 
     <a href="{{route('product_delete',$product_dataa->id)}}" class="btn btn-danger">delete</a>
  </td>
 </tr>
  @endforeach
   
  </tbody>
</table>
  </div>
</div>
      </div>


  <div class="col-lg-4">
    <div class="card  mb-3" >
  <div class="card-header text-white bg-danger">enter product</div>
  <div class="card-body">
<form action="{{route('product_post')}}" method="post" enctype="multipart/form-data">
    <div class="form-group">
      @csrf
    <label >select  Category</label>
    <select name="category_id" class="form-control">
      <option value="">--choose one--</option>
      @foreach ($category_info as $category_infos )
        
      <option value="{{$category_infos->id}}">{{$category_infos->category_name}}</option>
      @endforeach
    </select>
    </div>
    <div class="form-group">
      @csrf
    <label >select  subCategory</label>
    <select name="subCategory_id" class="form-control">
      <option value="">--choose one--</option>
      @foreach ($subCategory_info as $subCategory_infos )
        
      <option value="{{$subCategory_infos->id}}">{{App\Models\Category::find($subCategory_infos->category_id)->category_name}}>{{$subCategory_infos->sub_category_name}}</option>
      @endforeach
    </select>
    </div>
     <br>
    <label >product name</label>
    <input type="text" class="form-control"   placeholder="Enter product name" name="product_name">
     <br>
    <label >product price</label>
    <input type="text" class="form-control"   placeholder="product price" name="product_price">
     <br>
    <label >product  quantity</label>
    <input type="number" class="form-control"   placeholder=" product quantity" name="product_quantity">
     <br>
     <label >product  short description</label>
     <textarea name="product_short_description" class="form-control" id="" cols="20" rows="3"></textarea>
     <br>
     <label >product  long description</label>
         <textarea name="product_long_discription" class="form-control" id="" cols="20" rows="8"></textarea>
     <br>
     <label >alert quantity</label>
     <input type="number" class="form-control"   name="product_alert_quantity">
      <br>
     <label >product photo </label>
     <input type="file" class="form-control"   name="product_photo">
      <br>
     <label >featured  photos </label>
     <input type="file" class="form-control"   name="featured_product_photo[]" multiple>
      <br>

   <br>
      <br>
  <button type="submit" class="btn btn-primary">Add product now</button>
</form>
  </div>
</div>
   </div>




    </div>
<div class="row">
  <div class="col-lg-12">
    <div class="card  mb-3" >
  <div class="card-header text-white bg-primary">
       <div class="row">
        <div class="col-lg-9">delete list</div>
       <div class="col-lg-3"><a href="{{url('Product/all_restore')}}/{{$product_data}}" class="btn btn-success">restore all</a></div>
          
       </div>
  </div>
  <div class="card-body">
    <table class="table">
  <thead>
    <tr>
    <th scope="col">slno</th>
      <th scope="col">id</th>
      <th scope="col">Category name</th>
      <th scope="col">product name</th>
      <th scope="col">product photo</th>
      <th scope="col">product price</th>
      <th scope="col">product quantity</th>
      <th scope="col">short description</th>
      <th scope="col">long description</th>
      <th scope="col">created_at</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>


  @foreach ($product_trashed as $product_trashedd) 
  <tr>
  <th scope="row">{{$loop->index +1}}</th>
  <td>{{$product_trashedd->id}}</td>
  <td>{{App\Models\Category::find($product_trashedd->category_id)->category_name}}</td>
  <td>{{$product_trashedd->product_name}}</td>
  <td>{{$product_trashedd->product_photo}}</td>
  <td>{{$product_trashedd->product_price}}</td>
  <td>{{$product_trashedd->product_quantity}}</td>
  <td>{{$product_trashedd->product_short_description}}</td>
  <td>{{$product_trashedd->product_long_discription}}</td>
  <td>{{$product_trashedd->created_at}}</td>
  <td>
     <a href="{{route('product_restore',$product_trashedd->id)}}" class="btn btn-success">restore</a> 
     <a href="{{route('product_forcedelete',$product_trashedd->id)}}" class="btn btn-danger">force delete</a>
  </td>
 </tr>
  @endforeach


  </tbody>
</table>
  </div>
</div>
  </div>
</div>


    </div>
</div>
 </div>

@endsection
@section('footer_scripts')
    <script>
        $(document).ready(function(){
          $('#delete_all_btn').click(function(){
Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
      window.location.href="category/all/delete";
  }
})
        });

        $('#asad').click(function(){

          $('.checkdelete').attr( 'checked', 'checked' )

        });
        $('#asadd').click(function(){

          $('.checkdelete').removeAttr('checked')

        });
          });
          

    </script>

@endsection