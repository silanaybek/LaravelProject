@extends('layouts.app')

@section('title', 'Anasayfa')

@section('content')

{{-- Hero Slider --}}
@if($sliders->count())
<div id="heroSlider" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        @foreach($sliders as $i => $slider)
        <button type="button" data-bs-target="#heroSlider" data-bs-slide-to="{{ $i }}" {{ $i===0 ? 'class=active' : '' }}></button>
        @endforeach
    </div>
    <div class="carousel-inner">
        @foreach($sliders as $i => $slider)
        <div class="carousel-item {{ $i===0 ? 'active' : '' }}">
            <img src="{{ asset($slider->image) }}" class="d-block w-100" style="height:420px;object-fit:cover;" alt="{{ $slider->title }}">
            <div class="carousel-caption text-start" style="bottom:50px;left:60px;">
                <h2 style="font-size:2.2rem;font-weight:800;text-shadow:0 2px 8px rgba(0,0,0,.5);">{{ $slider->title }}</h2>
                @if($slider->subtitle)<p style="font-size:1.1rem;text-shadow:0 1px 4px rgba(0,0,0,.4);">{{ $slider->subtitle }}</p>@endif
                @if($slider->button_text)
                <a href="{{ $slider->button_link ?? route('products.index') }}" class="btn btn-danger px-4 py-2 fw-bold mt-2">{{ $slider->button_text }}</a>
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
<div style="background:#1a1a2e;padding:80px 0;text-align:center;color:#fff;">
    <div class="container">
        <h1 style="font-size:2.4rem;font-weight:800;">PikselPazar'a Hoş Geldiniz</h1>
        <p class="lead mb-4" style="color:rgba(255,255,255,.7);">En iyi ürünler, en uygun fiyatlarla</p>
        <a href="{{ route('products.index') }}" class="btn btn-danger btn-lg px-5 fw-bold">Alışverişe Başla</a>
    </div>
</div>
@endif

<div class="container" style="margin-top:32px;margin-bottom:48px;">

    {{-- Kategoriler --}}
    @if($categories->count())
    <div style="margin-bottom:40px;">
        <h5 style="font-weight:700;margin-bottom:16px;color:#111;">Kategoriler</h5>
        <div class="row g-3">
            @php
            $colors = ['#e94560','#0f3460','#11998e','#f7971e','#6c5ce7','#e17055','#00b894','#d63031'];
            @endphp
            @foreach($categories as $i => $cat)
            <div class="col-6 col-md-3 col-lg-2">
                <a href="{{ route('products.index', ['category' => $cat->slug]) }}"
                   style="display:flex;flex-direction:column;align-items:center;gap:10px;padding:20px 10px;background:#fff;border-radius:10px;border:1px solid #eee;text-decoration:none;color:#111;font-weight:600;font-size:.85rem;text-align:center;transition:box-shadow .2s;"
                   onmouseover="this.style.boxShadow='0 4px 16px rgba(0,0,0,.1)'"
                   onmouseout="this.style.boxShadow='none'">
                    <div style="width:48px;height:48px;border-radius:50%;background:{{ $colors[$i % count($colors)] }}22;display:flex;align-items:center;justify-content:center;">
                        <i class="fas fa-tag" style="color:{{ $colors[$i % count($colors)] }};font-size:1.1rem;"></i>
                    </div>
                    {{ $cat->name }}
                    <span style="font-size:.72rem;color:#999;font-weight:400;">{{ $cat->products_count }} ürün</span>
                </a>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Öne Çıkan Ürünler --}}
    @if($featured->count())
    <div style="margin-bottom:40px;">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;">
            <h5 style="font-weight:700;color:#111;margin:0;">Öne Çıkan Ürünler</h5>
            <a href="{{ route('products.index') }}" style="font-size:.85rem;color:#e94560;text-decoration:none;font-weight:600;">Tümünü Gör →</a>
        </div>
        <div class="row g-3">
            @foreach($featured as $product)
                @include('frontend._product_card', compact('product'))
            @endforeach
        </div>
    </div>
    @endif

    {{-- Kampanya Banner --}}
    <div style="background:#1a1a2e;border-radius:12px;padding:32px 40px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px;margin-bottom:40px;">
        <div>
            <p style="color:#e94560;font-size:.8rem;font-weight:700;text-transform:uppercase;letter-spacing:1px;margin-bottom:6px;">Özel Teklif</p>
            <h4 style="color:#fff;font-weight:800;margin-bottom:6px;">150 ₺ Üzeri Kargo Bedava!</h4>
            <p style="color:rgba(255,255,255,.6);font-size:.9rem;margin:0;">Tüm siparişlerinizde geçerlidir.</p>
        </div>
        <a href="{{ route('products.index') }}" class="btn btn-danger fw-bold px-4 py-2">Alışverişe Başla</a>
    </div>

    {{-- Yeni Gelenler --}}
    @if($latest->count())
    <div>
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;">
            <h5 style="font-weight:700;color:#111;margin:0;">Yeni Gelenler</h5>
            <a href="{{ route('products.index') }}" style="font-size:.85rem;color:#e94560;text-decoration:none;font-weight:600;">Tümünü Gör →</a>
        </div>
        <div class="row g-3">
            @foreach($latest->take(8) as $product)
                @include('frontend._product_card', compact('product'))
            @endforeach
        </div>
    </div>
    @endif

</div>

{{-- Alt bilgi şeridi --}}
<div style="background:#fff;border-top:1px solid #eee;padding:28px 0;margin-top:8px;">
    <div class="container">
        <div class="row text-center g-3">
            <div class="col-6 col-md-3">
                <i class="fas fa-shipping-fast" style="font-size:1.6rem;color:#e94560;margin-bottom:8px;display:block;"></i>
                <div style="font-weight:700;font-size:.9rem;">Hızlı Teslimat</div>
                <div style="font-size:.78rem;color:#888;">2-3 iş günü</div>
            </div>
            <div class="col-6 col-md-3">
                <i class="fas fa-lock" style="font-size:1.6rem;color:#e94560;margin-bottom:8px;display:block;"></i>
                <div style="font-weight:700;font-size:.9rem;">Güvenli Ödeme</div>
                <div style="font-size:.78rem;color:#888;">SSL korumalı</div>
            </div>
            <div class="col-6 col-md-3">
                <i class="fas fa-undo" style="font-size:1.6rem;color:#e94560;margin-bottom:8px;display:block;"></i>
                <div style="font-weight:700;font-size:.9rem;">Kolay İade</div>
                <div style="font-size:.78rem;color:#888;">30 gün garanti</div>
            </div>
            <div class="col-6 col-md-3">
                <i class="fas fa-headset" style="font-size:1.6rem;color:#e94560;margin-bottom:8px;display:block;"></i>
                <div style="font-weight:700;font-size:.9rem;">7/24 Destek</div>
                <div style="font-size:.78rem;color:#888;">Her zaman yanında</div>
            </div>
        </div>
    </div>
</div>

@endsection
