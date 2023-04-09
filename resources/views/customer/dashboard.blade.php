


 <div class="card">
             <div class="card-header">
                hello customer

             </div>

             <div class="card-body">
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">name</th>
      <th scope="col">phone number</th>
      <th scope="col">total</th>
      <th scope="col">action</th>
    </tr>
  </thead>
  <tbody>


    @foreach ($orders as  $order)
        
    <tr>
      <th scope="row">1</th>
      <td>{{$order->customer_name}}</td>
      <td>{{$order->customer_mobile_number}}</td>
      <td>{{$order->total}}</td>
      <td>
          <a href="{{url('download/invoice')}}/{{$order->id}}">
            <i class="fa fa-download"> download invoice</i>
        </a>
          <a href="{{url('give/review')}}/{{$order->id}}">
            <i class="fa fa-star"> product review</i>
        </a>
      </td>
    
    </tr>
    @endforeach

 
  </tbody>
</table>

             </div>





         </div>