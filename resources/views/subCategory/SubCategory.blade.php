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
          {{-- @if ($category_namee->count()!=0)
            <button class="btn btn-danger" id="delete_all_btn">Delete all</button>
          @endif --}}
          </div>
      </div>
  </div>
  <div class="card-body">
    {{-- @if (session('category_delete_status'))
      
    <div class="alert alert-danger">
      {{session('category_delete_status') }}
    </div>
    @endif --}}
   <table class="table">
  <thead>
    <tr>
      <th scope="col">slno</th>
      <th scope="col">id</th>
      <th scope="col">sub category name</th>
      <th scope="col">created_at</th>
      <th scope="col">upated_at</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($subCategory as $subCategorys )
      <tr>
      <td>{{$loop->index+1 }}</td>
      <td>{{ $subCategorys->id }}</td>
      <td>{{ $subCategorys->sub_category_name }}</td>
      <td>{{ $subCategorys->created_at }}</td>
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
  <div class="card-header text-white bg-danger">enter category</div>
  <div class="card-body">
<form action="{{route('sub_Category_post')}}" method="post" enctype="multipart/form-data">
    <div class="form-group">
      @csrf
    <label >select  category</label>
 <select name="category_id" id="" class="form-control">
    @foreach ($Category_info as $Category_infos)
        
    <option value="{{$Category_infos->id}}">{{$Category_infos->category_name}}</option>
    @endforeach
  
 </select>
     <br>

    </div>
    <div class="form-group">
    <label >subCategory</label>
    <input type="text"  class="form-control" name="sub_category_name"><br><br>
     <br>

    </div>

    <br>
    <br>
   



<br>

      
  <button type="submit" class="btn btn-primary">add sub_category_name</button>
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