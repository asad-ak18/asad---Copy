@extends('layouts.starlight')

@section('title')
     categorycoupon
@endsection
@section('Category')
     active
@endsection
@section('breadcrumb')
       <nav class="breadcrumb sl-breadcrumb">
        <a href="{{url('home')}}" class="breadcrumb-item">Dashboard</a>
        <span class="breadcrumb-item active">Category</span>
      </nav>
@endsection



@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <div class="card  mb-3" >
  <div class="card-header text-white bg-primary">
      <div class="row ">
        <div class="col-lg-9">coupon list</div>
        <div class="col-lg-3 ">
      
          </div>
      </div>
  </div>
  <div class="card-body">
 
   <table class="table">
  <thead>
    <tr>
      <th scope="col">slno</th>
      <th scope="col">id</th>
      <th scope="col">coupon_name</th>
      <th scope="col">discount_amount</th>
      <th scope="col">expire_date</th>
      <th scope="col">uses_limit</th>
      <th scope="col">created_At</th>
      <th scope="col">action</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($coupons as $coupon )
      <tr>
      <td>{{$loop->index+1 }}</td>
      <td>{{ $coupon->id }}</td>
      <td>{{ $coupon->coupon_name }}</td>
      <td>{{ $coupon->discount_amount }}</td>
      <td>{{ $coupon->expire_date }}</td>
      <td>{{ $coupon->uses_limit }}</td>
      <td>{{ $coupon->created_at}}</td>
      <td>
        {{-- <a href="{{}}" class="btn btn-danger">Delete</a> --}}
        <form action="{{route('coupon.destroy',$coupon->id)}}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Delete</button>
        </form>
      </td>
    </tr>
  @endforeach
    @csrf
    {{-- @forelse ($category_namee as $category_name)
      <tr>
       <td>
          
          <input type="checkbox"  name="category_id[]" class="checkdelete uncheck"  value="{{$category_name->id}}">
         </td>
      <th scope="row">{{$loop->index+1}}</th>
     
      <td>{{$category_name->id}}</td>
      <td>{{$category_name->category_name}}</td>
      <td>{{$category_name->created_at}}</td>
      <td>{{$category_name->updated_at}}</td>
      <td>
        {{-- <a href="#" class="btn btn-success">edit</a> --}}
        {{-- <a href="{{route('category_edit',$category_name->id)}}" class="btn btn-success">edit</a>
        <a href="{{route('Category_delete',$category_name->id)}}" class="btn btn-warning">delete</a>
      </td> --}}
      {{-- <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary">Read More</a> --}}
    </tr>


  
</form>
   
 
  </tbody>
</table>
  </div>
</div>
        </div>

   <div class="col-lg-3">
    <div class="card  mb-3" style="max-width: 18rem;">
  <div class="card-header text-white bg-danger">enter coupon</div>
  <div class="card-body">
<form action="{{route('coupon.store')}}" method="post" enctype="multipart/form-data">
   
      @csrf
              
    <div class="form-group">
    <label >coupon_name</label>
    <input type="text"  class="form-control" name="coupon_name"><br><br>
     <br>

    </div>
    <div class="form-group">
    <label >discount_amount</label>
    <input type="number"  class="form-control" name="discount_amount"><br><br>
     <br>

    </div>
    <div class="form-group">
    <label >expire_date</label>
    <input type="date"  class="form-control" name="expire_date"><br><br>
     <br>

    </div>
    <div class="form-group">
    <label >uses_limit</label>
    <input type="text"  class="form-control" name="uses_limit"><br><br>
     <br>

    </div>

    <br>
    <br>
   



<br>

      
  <button type="submit" class="btn btn-primary">add coupon</button>
</form>
  </div>
</div>
   </div>

    </div>






   
 
  </tbody>
</table>
  </div>
</div>
      </div>
    </div>
</div>

@endsection
