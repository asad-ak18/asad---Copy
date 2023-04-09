@extends('layouts.starlight')


@section('title')
   category edit-{{$category_id->category_name}}
@endsection

@section('content')
<div class="container">
@section('breadcrumb')
       <nav class="breadcrumb sl-breadcrumb">
        <a href="{{url('home')}}" class="breadcrumb-item">Dashboard</a>
        <a href="{{url('Category/category')}}" class="breadcrumb-item">Category</a>
        <span class="breadcrumb-item active">edit</span>
      </nav>
@endsection
    <div class="card text-white bg-success mb-3" >
  <div class="card-header">edit form</div>
  <div class="card-body">
    


    <form action="{{url('Category/post/edit')}}"   method="post">
      @csrf
  <div class="form-group">
    <label> category name</label>
    <input type="hidden" class="form-control"  placeholder="edit category" name="category_id" value="{{$category_id->id}}">
    <input type="text" class="form-control"  placeholder="edit category" name="category_name" value="{{$category_id->category_name}}">

  <button type="submit" class="btn btn-primary">Submit</button>
  <br>
  <br>
      @error('category_name')
          <span class="text-white">{{$message}}</span>
      @enderror
      @if (session('category_status'))
          
      <div class="alert alert-success">
           {{session('category_status')}}
      </div>
     
    
 
  </div>
  @endif
</form>
  
  </div>
</div>
</div>

@endsection