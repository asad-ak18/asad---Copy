@extends('layouts.starlight')


@section('content')

 <div class="container pt-5 text-dark">
   <form action="{{route('productdetail_faq_post')}}" method="post">
    @csrf

    
  <div class="form-group">
    <label>qus</label>
    <input type="text"  class="form-control"   placeholder="Enter qus" name="qus">

  </div>

  <div class="form-group">
    <label>ans</label>
    <textarea name="ans" id="" cols="136" rows="10"></textarea>

  </div>



  <div class="form-group">
    <label>quss</label>
    <input type="text"  class="form-control"   placeholder="Enter qus" name="quss">

  </div>
  <div class="form-group">
    <label>anss</label>
    <textarea name="anss" id="" cols="136" rows="10"></textarea>

  </div>
  <div class="form-group">
    <label>qusss</label>
    <input type="text"  class="form-control"   placeholder="Enter qus" name="qusss">

  </div>
  <div class="form-group">
    <label>ansss</label>
    <textarea name="ansss" id="" cols="136" rows="10"></textarea>

  </div>


  <button type="submit" class="btn btn-primary">Submit</button>
</form>
 </div>
@endsection