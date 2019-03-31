@extends('layouts.main')
@component('layouts.top-nav')    
@endcomponent

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/cart') }}">Cart</a></li>
        <li class="breadcrumb-item active">Checkout</li>
    </ol>
</nav>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h3>FINISH!</h3>
                <p>Transaksi selesai.</p>        
                <a href="{{ url('/') }}" class="btn btn-buy btn-info">Back to Shop</a>      
                <a href="#" class="btn btn-buy btn-primary">Login</a>         
            </div>
        </div>
    </div>
</div>
@endsection