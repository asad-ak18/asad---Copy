
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>invoice</title>
  </head>
  <body>
   
   <table class="table table-bordered">
 
    <tr>
   
      <td scope="col">name:{{$data->customer_name}}</td>
      <td scope="col">phone number:{{$data->customer_mobile_number}}</td>
      <td scope="col">customer_address:{{$data->customer_address}}</td>
    </tr>
 
   
 
</table>
   <table class="table table-bordered">
 
    <tr>
   
      <th scope="col">sl no</th>
      <th scope="col">product photo</th>
      <th scope="col">product name</th>
      <th scope="col">product quantity</th>
      <th scope="col">unit price</th>
      <th scope="col">product price</th>
    </tr>

    @foreach ($order_details as $order_detail )
        
    <tr>
   
      <td scope="col">{{$loop->index + 1}}</td>
      <td><img src="uploads/products_photo/{{$order_detail->relationtoproducttable->product_photo}}" alt=" not found" width="100"></td>
      <td scope="col">{{$order_detail->relationtoproducttable->product_name}}</td>
      <td scope="col">{{$order_detail->quantity}}</td>
      <td scope="col">{{$order_detail->relationtoproducttable->product_price*$order_detail->quantity}}</td>
      <td scope="col">{{$order_detail->relationtoproducttable->product_price}}</td>
     
    </tr>
    @endforeach
    {{-- <tr>
   
      <td scope="col">name:{{$data->customer_name}}</td>
      <td scope="col">phone number:{{$data->customer_mobile_number}}</td>
      <td scope="col">customer_address:{{$data->customer_address}}</td>
    </tr> --}}
 
</table>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>