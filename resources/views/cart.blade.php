@extends('layouts.tohoney')

@section('body')
      <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Shopping Cart</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span>Shopping Cart</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- cart-area start -->
    <div class="cart-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="{{route('update_cart')}}"  method="post">
                        @csrf
                        <table class="table-responsive cart-wrap">
                            <thead>
                                <tr>
                                    <th class="images">Image</th>
                                    <th class="product">Product</th>
                                    <th class="ptice">Price</th>
                                    <th class="quantity">Quantity</th>
                                    <th class="total">Total</th>
                                    <th class="remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $subtotal=0;
                                @endphp
                                @foreach ($cart as  $carts)     
                                <tr>
                                    <td class="images"><img src="{{asset('uploads/products_photo')}}/{{$carts->relationtoproducttable->product_photo}}" alt="" width="50"></td>
                                    <td class="product">
                                       {{$carts->relationtoproducttable->product_name}}
                                       {{-- {{$carts->relationtoproducttable->product_quantity}} --}}
                                        @if ($carts->relationtoproducttable->product_quantity < $carts->quantity)
                                            <span class="badge badge-danger">not available</span>
                                        @endif
                                    </td>
                                      
                                    <td class="ptice">${{$carts->relationtoproducttable->product_price}}</td>
                                    <td class="quantity cart-plus-minus">
                                        <input type="text" value="{{$carts->quantity}}" name="quantity[{{$carts->id}}]"/>
                                    </td>
                                    <td class="total"> ${{$carts->relationtoproducttable->product_price*$carts->quantity}}
                                       @php
                                           $subtotal +=( $carts->relationtoproducttable->product_price*$carts->quantity);
                                       @endphp
                                    
                                    </td>
                                    <td class="remove"><a href="{{route('cart_delete',$carts->id)}}"><i class="fa fa-times"></i></a></td>
                                </tr>
                                @endforeach


                             
                                
                                
                            </tbody>
                        </table>
                        <div class="row mt-60">
                            <div class="col-xl-4 col-lg-5 col-md-6 ">
                                <div class="cartcupon-wrap">
                                    <ul class="d-flex">
                                        <li>
                                            <button>Update Cart</button>
                                        </li>
                                        <li><a href="{{route('shop')}}">Continue Shopping</a></li>
                                    </ul>
                                    <h3>Coupon</h3>
                                    <p>Enter Your Coupon Code if You Have One</p>
                                    <div class="cupon-wrap">
                                        <input type="text" placeholder="Cupon Code"  id="apply_coupon_input" value="{{$coupon_name}}">
                                        <button type="button" id="apply_coupon">Apply Cupon</button>
                                         @if (session('coupon_err'))
                                             
                                         <div class="alert alert-danger">
                                              {{session('coupon_err')}}
                                         </div>
                                         @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                                <div class="cart-total text-right">
                                    <h3>Cart Totals</h3>
                                    <ul>
                                     
                                        <li><span class="pull-left">Subtotal </span>${{$subtotal}}</li>
                                        <li><span class="pull-left"> discount(%) </span> {{$coupon_discount}}</li>
                                        <li><span class="pull-left"> discount(in amount) </span> {{$subtotal -(($coupon_discount/100)*$subtotal)}}</li>
                                     
                                        <li><span class="pull-left"> Total </span> {{$subtotal -(($coupon_discount/100)*$subtotal)}}</li>
                                        @php
                                     
                                            session([
                                                   'session_coupon_name'=>$coupon_name,
                                                   'session_subtotal'=>$subtotal,
                                                   'session_coupon_discount'=>$coupon_discount,
                                                   'session_total'=>$subtotal -(($coupon_discount/100)*$subtotal),

                                    ]);
                                        @endphp
                                    </ul>
                                    <a href="{{route('checkout')}}">Proceed to Checkout</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- cart-area end -->
@endsection

@section('footer_scripts')
    <script>
        $(document).ready(function (){
            $('#apply_coupon').click(function(){
                var coupon_name =$('#apply_coupon_input').val();
                var link_to_go = "{{ route('cart') }}/" + coupon_name;
                window.location.href =link_to_go;
            });
        });

    </script>
@endsection