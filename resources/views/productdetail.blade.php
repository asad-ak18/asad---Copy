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
    <!-- single-product-area start-->
    <div class="single-product-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    
                   
                    <div class="product-single-img">
                        <div class="product-active owl-carousel">
                            @foreach (App\Models\Featured_photo::where('product_id',$product_info->id)->get() as $featured_photo)
                            <div class="item">
                                <img src="{{asset('uploads/products_featured')}}/{{$featured_photo->featured_photos_name}}" alt="">
                            </div>
                               
                           @endforeach


                        </div>
                        <div class="product-thumbnil-active  owl-carousel">
                                @foreach (App\Models\Featured_photo::where('product_id',$product_info->id)->get() as $featured_photo)
                            <div class="item">
                                <img src="{{asset('uploads/products_featured')}}/{{$featured_photo->featured_photos_name}}" alt="">
                            </div>
                               
                           @endforeach
                       
                        </div>
                    </div>
                </div>
          <div class="col-lg-6">
              <div class="product-single-content">
                  <h3>{{$product_info->product_name}}
                </h3>
                  <h6>available stocks:{{$product_info->product_quantity}}</h6>
                  <div class="rating-wrap fix">
                      <span class="pull-left">{{$product_info->product_price}}</span>
                      <ul class="rating pull-right">
                            @for ($a=1; $a<= floor($ovarall_review); $a++ )
                            <li><i class="fa fa-star"></i></li>
                            @endfor
                          @if (is_float($ovarall_review))
                              
                          <li><i class="fa fa-star-half-o"></i></li>
                        
                              
                          @endif
                          <li>({{$review->count()}} Customar Review)</li>
                      </ul>
                  </div>
                  <p>{{$product_info->product_short_description}}</p>
             <form action="{{route('cart_post',$product_info->id)}}" method="post">
                @csrf
                     <ul class="input-style">
                      <li class="quantity cart-plus-minus">
                          <input type="number" value="1"  name="quantity" >
                      </li>
                      <li><button class="btn btn-danger">Add to Cart</button></li>
                  </ul>
             </form>
             @if (session('error'))
             <div class="alert alert-danger">
                        {{session('error')}}
            </div>
                    @endif
                 
                  <ul class="cetagory">
                      <li>Categories:</li>

                           {{-- {{App\Models\Category::find($product_info->category_id)}} --}}
                          {{-- {{ App\Models\Category::find($product_info->category_id)->category_name }} --}}
                      <li><a href="#">{{App\Models\Category::find($product_info->category_id)->category_name}}</a></li>
                     
                  </ul>
                  <ul class="socil-icon">
                      <li>Share :</li>
                      
                     <li><a href="https://www.facebook.com/sharer.php?u={{url()->full()}}"><i class="fa fa-facebook"></i></a></li>

                      <li><a href="https://twitter.com/intent/tweet?u={{url()->full()}}"><i class="fa fa-twitter"></i></a></li>
                      <li><a href="https://www.linkedin.com/shareArticle?u={{url()->full()}}"><i class="fa fa-linkedin"></i></a></li>
                      <li><a href="https://plus.google.com/share?u={{url()->full()}}"><i class="fa fa-google-plus"></i></a></li>
                  </ul>
              </div>
          </div>
         

            </div>
            <div class="row mt-60">
                <div class="col-12">
                    <div class="single-product-menu">
                        <ul class="nav">
                            <li><a class="active" data-toggle="tab" href="#description">Description</a> </li>
                            <li><a data-toggle="tab" href="#tag">Faq</a></li>
                            <li><a data-toggle="tab" href="#review">Review</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-12">
                    <div class="tab-content">
                        <div class="tab-pane active" id="description">
                            <div class="description-wrap">
                               <p>{{$product_info->product_long_discription}}</p>
                            </div>
                        </div>
                        <div class="tab-pane" id="tag">
                          @foreach ($faq_info as $faq_infos )  
                                    <div class="faq-wrap" id="accordion">
                                            
                                        <div class="card">
                                            <div class="card-header" id="headingOne">
                                                <h5><button data-toggle="collapse" data-target="#collapseOne{{$faq_infos->id}}" aria-expanded="true" aria-controls="collapseOne"> {{$faq_infos->faq_qus}}</button> </h5> 
                                            </div>
                                            <div id="collapseOne{{$faq_infos->id}}" class="collapse {{($loop->index==0)?'show':''}}" aria-labelledby="headingOne" data-parent="#accordion">
                                                <div class="card-body">{{$faq_infos->faq_ans}}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach  
                        </div>

                        <div class="tab-pane" id="review">
                            <div class="review-wrap">
                                <ul>
                                @foreach ($review as $reviews )     
                                <li class="review-items">
                                    <div class="review-img">
                                        <img src="{{url('tohoney_asset/assets/images/comment/1.png')}}" alt="">
                                    </div>
                                    <div class="review-content">
                                        <h3><a href="#">{{App\Models\user::find($reviews->user_id)->name}}</a></h3>
                                        <span>{{$reviews->created_at}}</span>
                                        <p>{{$reviews->review}}</p>
                                        <ul class="rating">

                                          @for ($x=1; $x<=$reviews->stars; $x++ )
                                              
                                          <li><i class="fa fa-star"></i></li>
                                          @endfor

                                          
                                  
                                        </ul>
                                    </div>
                                </li>
                                @endforeach

                                </ul>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- single-product-area end-->
    <!-- featured-product-area start -->
    <div class="featured-product-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-left">
                        <h2>Related Product</h2>
                    </div>
                </div>
            </div>
            <div class="row">
             @forelse ($related_product as $related_products)
                 
             <div class="col-lg-3 col-sm-6 col-12">
                 <div class="featured-product-wrap">
                     <div class="featured-product-img">
                         <img src="{{asset('uploads/products_photo')}}/{{$related_products->product_photo}}" alt="">
                     </div>
                     <div class="featured-product-content">
                         <div class="row">
                             <div class="col-7">
                                 <h3><a href="{{route('productdetail',$related_products->id)}}">{{$related_products->product_name}}</a></h3>
                                 <p>${{$related_products->product_price}}</p>
                             </div>
                             <div class="col-5 text-right">
                                 <ul>
                                     <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                     <li><a href="cart.html"><i class="fa fa-heart"></i></a></li>
                                 </ul>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             @empty
               nai
             @endforelse

                
        

              

              
            </div>
        </div>
    </div>
    <!-- featured-product-area end -->
@endsection