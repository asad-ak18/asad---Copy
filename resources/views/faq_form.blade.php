@extends('layouts.starlight')


@section('content')

 <div class="container pt-5 text-dark">
   <form action="{{route('faq_form_post')}}" method="post">
    @csrf

    
  <div class="form-group">
    <label>qus</label>
    <input type="text"  class="form-control"   placeholder="Enter qus" name="faq_qus">

  </div>

  <div class="form-group">
    <label>ans</label>
    <textarea name="faq_ans" id="" cols="136" rows="10"></textarea>

  </div>



  <div class="form-group">
    <label>quss</label>
    <input type="text"  class="form-control"   placeholder="Enter qus" name="faq_quss">

  </div>
  <div class="form-group">
    <label>anss</label>
    <textarea name="faq_anss" id="" cols="136" rows="10"></textarea>

  </div>
  <div class="form-group">
    <label>qusss</label>
    <input type="text"  class="form-control"   placeholder="Enter qus" name="faq_qusss">

  </div>
  <div class="form-group">
    <label>ansss</label>
    <textarea name="faq_ansss" id="" cols="136" rows="10"></textarea>

  </div>


  <button type="submit" class="btn btn-primary">Submit</button>
</form>
 </div>
@endsection