@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="container my-4">
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-danger">Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}" class="text-danger">Ürünler</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="text-danger">{{ $product->category->name }}</a></li>
            <li class="breadcrumb-item active">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-5">
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid rounded-3 shadow-sm" alt="{{ $product->name }}" style="width:100%;">
            @else
                <div style="height:400px;background:#f0f0f0;border-radius:12px;display:flex;align-items:center;justify-content:center;">
                    <i class="fas fa-image fa-4x text-muted"></i>
                </div>
            @endif
        </div>
        <div class="col-md-7">
            <small class="text-muted">{{ $product->category->name }}</small>
            <h1 class="mt-1 mb-3" style="font-size:1.8rem;font-weight:700;">{{ $product->name }}</h1>

            <div class="mb-3">
                @if($product->discount_price)
                    <span style="font-size:2rem;font-weight:700;color:#e94560;">{{ number_format($product->discount_price, 2) }} ₺</span>
                    <span class="ms-2" style="font-size:1.1rem;text-decoration:line-through;color:#aaa;">{{ number_format($product->price, 2) }} ₺</span>
                    <span class="badge ms-2" style="background:#e94560;">
                        -%{{ round((($product->price - $product->discount_price) / $product->price) * 100) }}
                    </span>
                @else
                    <span style="font-size:2rem;font-weight:700;color:#e94560;">{{ number_format($product->price, 2) }} ₺</span>
                @endif
            </div>

            @if($product->description)
            <p class="text-muted mb-4">{{ $product->description }}</p>
            @endif

            <div class="mb-3">
                @if($product->stock > 10)
                    <span class="badge bg-success">Stokta Var ({{ $product->stock }})</span>
                @elseif($product->stock > 0)
                    <span class="badge bg-warning text-dark">Az Stok ({{ $product->stock }})</span>
                @else
                    <span class="badge bg-danger">Tükendi</span>
                @endif
            </div>

            @if($product->stock > 0)
            <form method="POST" action="{{ route('cart.add') }}" class="d-flex gap-3 align-items-center">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="input-group" style="width:130px;">
                    <span class="input-group-text">Adet</span>
                    <input type="number" name="quantity" class="form-control" value="1" min="1" max="{{ $product->stock }}">
                </div>
                <button type="submit" class="btn btn-lg px-4 fw-bold" style="background:#e94560;color:#fff;border:none;border-radius:10px;">
                    <i class="fas fa-cart-plus me-2"></i>Sepete Ekle
                </button>
            </form>
            @endif
        </div>
    </div>

    @if($related->count())
    <div class="mt-5">
        <h4 class="section-title">Benzer Ürünler</h4>
        <div class="row g-4">
            @foreach($related as $product)
                @include('frontend._product_card', compact('product'))
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
