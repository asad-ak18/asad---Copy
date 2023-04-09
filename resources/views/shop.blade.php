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
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="product-menu">
                        <ul class="nav justify-content-center">
                            <li>
                                <a class="active" data-toggle="tab" href="#all">All product</a>
                            </li>

                            @foreach ($category_name as  $category_names)
                                
                            <li>
                                <a data-toggle="tab" href="#dynamic_id_{{$category_names->id}}">{{$category_names->category_name}}</a>
                            </li>
                            @endforeach
                         
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="all">
                    <ul class="row">
                        @foreach ($all_products as $product_dataa)
                              @include('little_parts.asad')
                 
                        @endforeach

                        <li class="col-12 text-center">
                            <a class="loadmore-btn" href="javascript:void(0);">Load More</a>
                        </li>
                    </ul>
                </div>

                 @foreach ($category_name as  $category_names)
                  
                <div class="tab-pane" id="dynamic_id_{{$category_names->id}}">
                        {{-- @php
                         echo   App\Models\product::where('category_id',$category_names->id)->get();
                        @endphp --}}
                    <ul class="row">
                      
                        
                            @foreach (App\Models\product::where('category_id',$category_names->id)->get() as  $category_names )
                                
                            @include('little_parts.asad')
                            @endforeach
                    
                     
                    </ul>
                </div>
                  @endforeach
            </div>
        </div>
    </div>
    <!-- product-area end -->
@endsection