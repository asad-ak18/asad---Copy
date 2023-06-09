@extends('layouts.tohoney')

@section('body')
 <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Account</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span>Register</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- checkout-area start -->
    <div class="account-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">

                    @if (session('cus_log_err'))
                        
                    <div class="alert alert-danger">
                      {{ session('cus_log_err')}}
                    </div>
                    @endif

               <form action="{{route('customer_signin_post')}}" method="post">
                @csrf
                     <div class="account-form form-style">
                        {{-- <p>User name *</p>
                        <input type="text" name="name"> --}}
                        <p>User Email Address *</p>
                        <input type="email" name="email">
                        <p>Password *</p>
                        <input type="Password" name="password">
                       
                        <div class="text-center">
                            <button>Login</button>
                        </div>
                        <div class="text-center">
                            <a href="{{route('customer_register')}}">Or register</a>
                        </div>
                    </div>
               </form>
                </div>
            </div>
        </div>
    </div>
    <!-- checkout-area end -->


@endsection