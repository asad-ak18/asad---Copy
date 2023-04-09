@extends('layouts.tohoney')

@section('body')
      <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Checkout</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span>Checkout</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- checkout-area start -->

          @auth

          @if (Auth::user()->role ==2)
      <div class="checkout-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="checkout-form form-style">
                        <h3>Billing Details
                            logged in as:{{Auth::User()->name}}
                        </h3>
                  
                        <form action="{{route('checkout_post')}}" method="post" id="main_form">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <p>Name *</p>
                                    <input type="text" name="customer_name" value="{{Auth::User()->name}}">
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Email Address *</p>
                                    <input type="email" value="{{Auth::User()->email}}" name="customer_email">
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Phone No. *</p>
                                    <input type="number"  name="customer_mobile_number">
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Country *</p>
                                    <select id="country_list" name="customer_country_id">
                                        <option value="">--select country--</option>

                                        @foreach ($countries as  $country)
                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>City *</p>
                                       <select id="city_list" name="customer_city_id">
                                        <option value="">--select city--</option>
                                        <option value="1">Dhaka</option>

                                     
                                    </select>
                                </div>                                
                                <div class="col-12">
                                    <p>Your Address *</p>
                                    <input type="text" name="customer_address">
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Postcode/ZIP</p>
                                    <input type="text" name="customer_post_code" >
                                </div>
                                                 
                                <div class="col-12">
                                    <p>Order Notes </p>
                                    <textarea name="massage" placeholder="Notes about Your Order, e.g.Special Note for Delivery"></textarea>
                                </div>
                            </div>
                        
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="order-area">
                        <h3>Your Order</h3>
                        <ul class="total-cost">
                            <li>coupon name <span class="pull-right">{{(session('session_coupon_name')) ? session('session_coupon_name'):"not applicable"}}</span></li>
                            <li>coupon discount <span class="pull-right">{{session('session_coupon_discount')}}</span></li>
                            <li>Subtotal <span class="pull-right"><strong>${{session('session_subtotal')}}</strong></span></li>
                            <li>Shipping <span class="pull-right">Free</span></li>
                            <li>Total<span class="pull-right">${{session('session_total')}}</span></li>
                        </ul>
                        <ul class="payment-method">                            
                            <li>
                                <input id="card" type="radio" name="payment_option" value="1" checked>
                                <label for="card">Credit Card</label>
                            </li>
                            <li>
                                <input id="delivery" type="radio" name="payment_option" value="2">
                                <label for="delivery">Cash on Delivery</label>
                            </li>
                        </ul>
                        <button type="button" id="place_order_btn">Place Order</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
      @else
          <div class="checkout-area ptb-100">
             <div class="container">
                  <div class="row">
                     <div class="col-12">
                         <div class="alert alert-danger">
                             you are an admin,you can not chekedout
                         </div>

                     </div>
                 </div>
             </div>
    @endif
    <!-- checkout-area end -->
@else
     
           <div class="checkout-area ptb-100">
             <div class="container text-center">
                  <div class="row">
                     <div class="col-12">
                         <div class="alert alert-danger">
                              if you have no account,you have to create account<a href="{{route('customer_register')}}"><h2>signup</h2></a><br>
                              or if you have account,log in your account <a href="{{route('customer_signin')}}"><h2>login</h2></a>
                              
                         </div>

                     </div>
                 </div>
             </div>
  




                        @endauth

                            
    



  
@endsection



@section('footer_scripts')
  
<script>
    $(document).ready(function() {
    $('#country_list').select2();
    $('#city_list').select2();
    $('#country_list').change(function(){
        var country_id = $(this).val();
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

  $.ajax({
      type:'POST',
      url:'get/city/list',
      data:{country_id:country_id},
      success:function(data){
        $('#city_list').html(data);
      }
  });


    });

    $('#place_order_btn').click(function(){
      
      if($('input[name="payment_option"]:checked').val() == 1){
          var link ="{{ url('pay') }}"
          $('#main_form').attr('action', link);
      }
      else{

          $('#main_form').attr('action', 'http://127.0.0.1:8000/checkout/post');
      }
      $('#main_form').submit();
      
    });
});
</script>
@endsection