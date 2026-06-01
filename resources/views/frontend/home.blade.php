@extends('layouts.app')

@section('title', 'Anasayfa')

@section('content')
{{-- Hero Slider --}}
@if($sliders->count())
<div id="heroSlider" class="carousel slide hero-slider" data-bs-ride="carousel">
    <div class="carousel-indicators">
        @foreach($sliders as $i => $slider)
        <button type="button" data-bs-target="#heroSlider" data-bs-slide-to="{{ $i }}" {{ $i===0?'class=active':'' }}></button>
        @endforeach
    </div>
    <div class="carousel-inner">
        @foreach($sliders as $i => $slider)
        <div class="carousel-item {{ $i===0?'active':'' }}">
            <img src="{{ asset('storage/'.$slider->image) }}" class="d-block w-100" alt="{{ $slider->title }}">
            <div class="carousel-caption">
                <h2>{{ $slider->title }}</h2>
                @if($slider->subtitle)<p>{{ $slider->subtitle }}</p>@endif
                @if($slider->button_text)
                <a href="{{ $slider->button_link ?? route('products.index') }}" class="btn btn-shop btn-lg mt-2">
                    {{ $slider->button_text }} <i class="fas fa-arrow-right ms-2"></i>
                </a>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#heroSlider" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroSlider" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>
@else
<div style="background:linear-gradient(135deg,#1a1a2e,#e94560);padding:100px 0;text-align:center;color:#fff;">
    <div class="container">
        <h1 style="font-size:3rem;font-weight:700;">ShopZone'a Hoş Geldiniz</h1>
        <p class="lead mb-4">En iyi ürünler, en uygun fiyatlarla</p>
        <a href="{{ route('products.index') }}" class="btn btn-light btn-lg px-5 rounded-pill fw-bold">Alışverişe Başla</a>
    </div>
</div>
@endif

{{-- Categories --}}
@if($categories->count())
<div class="container my-5">
    <h2 class="section-title">Kategoriler</h2>
    <div class="row g-3">
        @foreach($categories as $cat)
        <div class="col-6 col-md-3 col-lg-2">
            <a href="{{ route('products.index', ['category' => $cat->slug]) }}" class="cat-card">
                @if($cat->image)
                    <img src="{{ asset('storage/'.$cat->image) }}" alt="{{ $cat->name }}">
                @else
                    <div style="height:150px;background:linear-gradient(135deg,#e94560,#1a1a2e);display:flex;align-items:center;justify-content:center;">
                        <i class="fas fa-tags fa-3x text-white"></i>
                    </div>
                @endif
                <div class="cat-body">
                    <strong>{{ $cat->name }}</strong>
                    <div class="text-muted" style="font-size:.8rem;">{{ $cat->products_count }} ürün</div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endif

{{-- Featured Products --}}
@if($featured->count())
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="section-title mb-0">Öne Çıkan Ürünler</h2>
        <a href="{{ route('products.index') }}" class="btn btn-outline-danger btn-sm rounded-pill">Tümünü Gör</a>
    </div>
    <div class="row g-4">
        @foreach($featured as $product)
            @include('frontend._product_card', compact('product'))
        @endforeach
    </div>
</div>
@endif

{{-- Latest Products --}}
@if($latest->count())
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="section-title mb-0">Yeni Gelenler</h2>
        <a href="{{ route('products.index') }}" class="btn btn-outline-danger btn-sm rounded-pill">Tümünü Gör</a>
    </div>
    <div class="row g-4">
        @foreach($latest as $product)
            @include('frontend._product_card', compact('product'))
        @endforeach
    </div>
</div>
@endif

{{-- Features Section --}}
<div style="background:#fff;padding:3rem 0;margin-top:2rem;">
    <div class="container">
        <div class="row text-center g-4">
            <div class="col-md-3">
                <i class="fas fa-shipping-fast fa-2x mb-3" style="color:#e94560;"></i>
                <h6 class="fw-bold">Hızlı Teslimat</h6>
                <small class="text-muted">Siparişiniz 2-3 iş gününde kapınızda</small>
            </div>
            <div class="col-md-3">
                <i class="fas fa-shield-alt fa-2x mb-3" style="color:#e94560;"></i>
                <h6 class="fw-bold">Güvenli Ödeme</h6>
                <small class="text-muted">256-bit SSL ile güvenli alışveriş</small>
            </div>
            <div class="col-md-3">
                <i class="fas fa-undo fa-2x mb-3" style="color:#e94560;"></i>
                <h6 class="fw-bold">Kolay İade</h6>
                <small class="text-muted">30 gün içinde ücretsiz iade</small>
            </div>
            <div class="col-md-3">
                <i class="fas fa-headset fa-2x mb-3" style="color:#e94560;"></i>
                <h6 class="fw-bold">7/24 Destek</h6>
                <small class="text-muted">Her zaman yanınızdayız</small>
            </div>
        </div>
    </div>
</div>
@endsection
