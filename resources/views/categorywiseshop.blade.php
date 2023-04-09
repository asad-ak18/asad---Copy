@extends('layouts.tohoney')
@section('body')
   <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Shop Page</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span>Shop</span></li>
                            <li><span>{{$category_name}}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
     <!-- product-area start -->
    <div class="product-area pt-100">
        <div class="container">
         
            <div class="tab-content">
                <div class="tab-pane active" id="all">
                    <ul class="row">
                   
                         @foreach ($product_data as $product_dataa)
                              @include('little_parts.asad')
                 
                        @endforeach
                    
                     
                    </ul>
                </div>
                 
            </div>
        </div>
    </div>
    <!-- product-area end -->


@endsection