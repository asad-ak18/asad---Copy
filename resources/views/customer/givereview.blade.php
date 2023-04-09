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
  <div class="card-header text-dark bg-light">
      <div class="row ">
          <div class="col-lg-12 ">
                 @foreach ($order_details as  $order_detail)

                 @if(App\Models\review::where('order_details_id',$order_detail->id)->exists())
                      done
                      @else
                            <div class="col-lg-9">{{ App\Models\product::find($order_detail->product_id)->product_name }} 
   
                                <div class="card-body">
                         
                                    <form action="{{url('review/post')}}/{{$order_detail->id}}"  method="POST">
                                        @csrf
                                    <input type="text" name="review" class="form-control">
                                    <br>
                                    <input type="range" id="points" name="stars" min="1" max="5" step="1" value="1" >
                                    <br>
                                    <button class="btn btn-success" type="submit">give review</button>

                                    </form>
                                   
                                </div>
                            </div>
                                @endif
                      

        @endforeach

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