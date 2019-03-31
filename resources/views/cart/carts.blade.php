@extends('layouts.main')
@component('layouts.top-nav')    
@endcomponent

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Products</a></li>
        <li class="breadcrumb-item active">Cart</li>
    </ol>
</nav>
<div class="content">
<form action="{{ url('/cart/update') }}" method="POST">
    @csrf()
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Cart</h1>
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {!! Session::get('success') !!}
                    </div>
                @endif
                <div class="text-right">
                    <a href="{{ url('/cart/clear') }}" class="link-clear">Clear All</a>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <td colspan="2">Product</td>
                            <td width="10%">Quantity</td>
                            <td>Price</td>
                            <td>Total</td>
                            <td></td>
                        </tr>
                    </thead>                       
                    <tbody>
                        @if (\Cart::getTotalQuantity() == 0)
                            <tr>
                                <td colspan="6">No result cart. you can go to shopping <strong><a href="{{ url('/') }}">here</a></strong></td>
                            </tr>
                        @endif
                        @foreach ($carts as $cart)
                            <input type="hidden" name="product_id[]" class="form-control" value="{{ $cart['id'] }}">   
                            <tr>
                                <td width="10%"><img src="{{ url('public/img/products/'.$cart['attributes']['image']) }}" class="img img-fluid" alt=""></td>
                                <td width="35%">
                                    <p><b><a href="{{ url('/product/detail/'.$cart['id']) }}">{{ $cart['attributes']['brand'] }} - {{ $cart['name'] }}</a></b></p>
                                    <p>{{ $cart['attributes']['model'] }}</p>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" name="qty[]" class="form-control" value="{{ $cart['quantity'] }}">  
                                    </div>                       
                                </td>
                                <td><span class="price">{{ number_format($cart['price']) }}</span></td>
                                <td><span class="price">{{ number_format($cart['price'] * $cart['quantity']) }}</span></td>
                                <td><a href="{{ url('/cart/remove/'.$cart['id']) }}" class="btn btn-sm btn-danger" title="delete">X</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-right">
                <div class="total-price">Total: <span class="price">{{ number_format(\Cart::getTotal()) }}</span></div>
                @if (\Cart::getTotalQuantity() > 0)
                <button type="submit" class="btn btn-buy btn-success">Update Cart</button>       
                <a href="{{ url('/cart/checkout') }}" class="btn btn-buy btn-primary">Checkout</a>
                @endif
            </div>
        </div>
    </div>
</form>
</div>
@endsection