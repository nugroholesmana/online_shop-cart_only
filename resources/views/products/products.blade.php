@extends('layouts.main')
@component('layouts.top-nav')    
@endcomponent

@section('content')
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p><b>Catalog Product</b></p>
                <hr>
            </div>
        </div>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-3">
                    <div class="product">
                        <div class="product-img">
                            <a href="{{ url('/product/detail/'.$product->id) }}">
                                <img src="{{ url('public/img/products/'.$product->hasOneProductImage->name) }}" alt="" class="img img-fluid">
                            </a>
                        </div>
                        <div class="product-info">
                            <p class="brand-name">{{ $product->hasOneBrand->name }} - {{ $product->name }}</p>
                            <p class="model">{{ $product->model }}</p>  
                            <p class="price">{{ number_format($product->price_sell) }}</p>
                        </div>
                        <div class="product-action">
                            <a href="{{ url('/product/detail/'.$product->id) }}" class="btn btn-sm btn-info">Detail</a>
                            <a href="{{ url('/cart/add/'.$product->id) }}" class="btn btn-sm btn-primary">Buy Now</a>
                        </div>
                    </div>
                </div>
            @endforeach            
        </div>
    </div>
</div>
@endsection