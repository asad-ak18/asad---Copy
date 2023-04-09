@extends('layouts.starlight')

@section('title')
     categoryhome
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
        <div class="col-lg-9">category list</div>
        <div class="col-lg-3 ">
          @if ($category_namee->count()!=0)
            <button class="btn btn-danger" id="delete_all_btn">Delete all</button>
          @endif
          </div>
      </div>
  </div>
  <div class="card-body">
    @if (session('category_delete_status'))
      
    <div class="alert alert-danger">
      {{session('category_delete_status') }}
    </div>
    @endif
   <table class="table">
  <thead>
    <tr>
      <th scope="col">delete?</th>
      <th scope="col">slno</th>
      <th scope="col">id</th>
      <th scope="col">category name</th>
      <th scope="col">created_at</th>
      <th scope="col">upated_at</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <form action="{{route('category_checkdelete')}}" method="post">
    @csrf
    @forelse ($category_namee as $category_name)
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
        <a href="{{route('category_edit',$category_name->id)}}" class="btn btn-success">edit</a>
        <a href="{{route('Category_delete',$category_name->id)}}" class="btn btn-warning">delete</a>
      </td>
      {{-- <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary">Read More</a> --}}
    </tr>
    @empty
      <tr>
           <td colspan="50" class="text-center text-danger">no data to show</td>
        </tr>
      
    @endforelse

  <tr>
    <td>
        <button type ="button"id ="asad" class=" btn btn-info" > check all</button>

    </td>
    <td>
          <button type="button" id ="asadd" class=" btn btn-info" > uncheck all</button>

    </td>
    <td>
          <button type="submit" class=" btn btn-info" > check delete</button>

    </td>
   </form>
  </tr>
   
 
  </tbody>
</table>
  </div>
</div>
        </div>

   <div class="col-lg-3">
    <div class="card  mb-3" style="max-width: 18rem;">
  <div class="card-header text-white bg-danger">enter category</div>
  <div class="card-body">
<form action="{{route('category_post')}}" method="post" enctype="multipart/form-data">
    <div class="form-group">
      @csrf
    <label >select  category</label>
    <input type="text" class="form-control"   placeholder="Enter category name" name="category_name">
     <br>
    @error('category_name')
          <span class="text-danger">{{$message}}</span>
      @enderror
      @if (session('category_status'))
          
      <div class="alert alert-success">
           {{session('category_status')}}
      </div>
     @endif
    
    </div>
    <div class="form-group">
   
    <label >select  subcategory</label>
    <input type="text" class="form-control"   placeholder="Enter category name" name="sub_category_name" value="{{old('sub_category_name')}}">
     <br>
    @error('subCategory_status')
          <span class="text-danger">{{$message}}</span>
      @enderror
      @if (session('subCategory_status'))
          
      <div class="alert alert-success">
           {{session('subCategory_status')}}
      </div>
     
    
    </div>
    @endif
    <br>
    <br>
    <input type="file"  class="form-control" name="category_photo"><br><br>

      
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
  </div>
</div>
   </div>

    </div>


    <div class="row">
      <div class="col-lg-12">
        <div class="card mb-3" >
  <div class="card-header text-white bg-primary ">
       <div class="row">
        <div class="col-lg-9">delete list</div>
        <div class="col-lg-3"><a href="{{url('Category/all_restore')}}/{{$deleted_categoryies}}" class="btn btn-success">restore all</a></div>
              {{-- <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary">Read More</a> --}}
       </div>


  </div>
  <div class="card-body">
        <table class="table">
  <thead>
    <tr>
      <th scope="col">slno</th>
      <th scope="col">id</th>
      <th scope="col">category name</th>
      <th scope="col">category photo</th>
      <th scope="col">created_at</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  
    @forelse ($deleted_categoryies as $deleted_categoriess)
      <tr>
      <th scope="row">{{$loop->index+1}}</th>
     
      <td>{{$deleted_categoriess->id}}</td>
      <td>{{$deleted_categoriess->category_name}}</td>
      <td>{{$deleted_categoriess->category_photo}}</td>
      <td>{{$deleted_categoriess->created_at}}</td>
      <td>
        {{-- <a href="#" class="btn btn-success">edit</a> --}}
        <a href="{{route('category_restore',$deleted_categoriess->id)}}" class="btn btn-success">restore</a>
        <a href="{{route('category_forcedelete',$deleted_categoriess->id)}}" class="btn btn-danger">force delete</a>
      </td>
       {{-- <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary">Read More</a> --}}
      
    </tr>
    @empty
      <tr>
           <td colspan="50" class="text-center text-danger">no data to show</td>
        </tr>
      
    @endforelse


   
 
  </tbody>
</table>
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