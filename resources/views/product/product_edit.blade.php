@extends('layouts.starlight')

@section('title')
     product edit
@endsection


@section('breadcrumb')
       <nav class="breadcrumb sl-breadcrumb">
        <a href="{{url('home')}}" class="breadcrumb-item">Dashboard</a>
        <a href="{{url('Product/product')}}" class="breadcrumb-item">product</a>
        <span class="breadcrumb-item active">product edit</span>
      </nav>
@endsection

@section('content')
  <div class="card text-white bg-success mb-3" >
  <div class="card-header">edit form</div>
  <div class="card-body">
    


    <form action="{{route('product_edit_post',$product_id->id)}}"   method="post" enctype="multipart/form-data">
      @csrf
  <div class="form-group">
       <label >product name</label>
           {{-- <input type="hidden" class="form-control"  placeholder="edit product" name="product_id" value="{{$product_id->id}}"> --}}
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
    {{-- <input type="hidden" class="form-control"  placeholder="edit category" name="category_id" value="{{$category_id->id}}"> --}}

   
       <br>
     <label >current photo </label>
    {{$product_id->product_photo }}
     {{-- <input type="file" class="form-control"   name="product_photo"  value=""> --}}
     <img src="{{asset('uploads/products_photo')}}/{{$product_id->product_photo}}" alt="" value="{{asset('uploads/products_photo')}}/{{$product_id->product_photo}}" >
      <br>
     <label >new photo </label>
     <input type="file" class="form-control"   name="product_new_photo"  value="">

      <br>

  <button type="submit" class="btn btn-primary">Submit</button>
  <br>
  <br>
      @error('product_name')
          <span class="text-white">{{$message}}</span>
      @enderror
      {{-- @if (session('category_status'))
          
      <div class="alert alert-success">
           {{session('category_status')}}
      </div>
     
    
 
  </div>
  @endif --}}
</form>
  
  </div>
</div>


@endsection