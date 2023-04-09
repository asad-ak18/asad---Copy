@extends('layouts.starlight')

@section('title')
    web_s
@endsection
@section('web_s')
     active
@endsection
@section('breadcrumb')
       <nav class="breadcrumb sl-breadcrumb">
        <a href="{{url('home')}}" class="breadcrumb-item">Dashboard</a>
        <span class="breadcrumb-item active">product</span>
      </nav>
@endsection



@section('content')
<div class="container text-center ">
  

       

    
    <div class="row">

  <div class="col-lg-6">
    <div class="card  mb-3" >
  <div class="card-header text-white bg-danger">enter product</div>
  <div class="card-body">
    
<form action="{{route('settings_post')}}" method="post" enctype="multipart/form-data">
    <div class="form-group">
      @csrf
 
     <br>
    <label >phone number</label>
    <input type="number" class="form-control"   placeholder="Enter product name" name="phone_number" value="{{$web_s_info->where('settings_name','phone_number')->first()->settings_value}}">
   

    </div>
    <div class="form-group">
     
    
     <br>
    <label >email</label>
    <input type="email" class="form-control"   placeholder="Enter product name" name="email" value="{{$web_s_info->where('settings_name','email')->first()->settings_value}}">
   
</div>
<button type="submit" class="btn btn-primary">update settings</button>
</form>
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