@extends('layouts.tohoney')
@section('body')
    <div class="container">
        <div class="row">
        @foreach ($search_product as $search_products )

        {{$search_products->product_name}}
            
        @endforeach
    </div>
    </div>
   


@endsection