@extends('layouts.main')
@component('layouts.top-nav')    
@endcomponent

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Products</a></li>
        <li class="breadcrumb-item active">Detail Product</li>
    </ol>
</nav>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div id="carouselExample" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExample" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExample" data-slide-to="1"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ url('public/img/products/'.$product->hasOneProductImage->name) }}" alt="" class="img img-fluid">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ url('public/img/products/'.$product->hasOneProductImage->name) }}" alt="" class="img img-fluid">
                        </div>
                    </div>
                    <a href="#carouselExample" class="carousel-control-prev" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a href="#carouselExample" class="carousel-control-next" role="button" data-slide="next">
                        <span class="carousel-control-nex-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>                
            </div> 
            <div class="col-md-8">
                <h3>{{ $product->hasOneBrand->name }} - {{ $product->name }} {{ $product->model }}</h3>
                <p><b>{{ $product->hasOneCategory->name }} - {{ strtoupper($product->hasOneCategorysub->name) }}</b></p>
                <div class="product-detail">
                    <h3 class="price">{{ number_format($product->price_sell) }}</h3>
                    <p><b>Description</b></p>
                    <p class="description">{!! $product->description !!}</p>
                </div>   
                <a href="{{ url('/cart/add/'.$product->id) }}" class="btn btn-buy btn-primary">BUY NOW</a>             
            </div>
            <div class="col-md-12">
                <div class="row card-content">
                    <div class="col-md-12">
                        <h3>Spesification</h3>
                    </div>
                    @foreach ($category_attributes['category_attribute'] as $category_attribute)
                        @php 
                            $product_attrs = App\Models\ProductAttribute::where('category_attribute_id', $category_attribute['id'])
                                        ->where('product_id', $product->id)
                                        ->get();
                        @endphp
                        <div class="col-md-6">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <th colspan="2">{{ $category_attribute['name'] }}</th>
                                    </tr>
                                    @foreach ($product_attrs as $product_attr)
                                    <tr>
                                        <td><strong>{{ $product_attr->belongsToCategorySubattribute->name }}</strong></td>
                                        <td>{{ $product_attr->value }} {!! $product_attr->desc ? '<i class="icon fas fa-question-circle" title="'.$product_attr->desc.'"></i>' : null !!}</td>
                                    </tr>                                
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endforeach                   
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection