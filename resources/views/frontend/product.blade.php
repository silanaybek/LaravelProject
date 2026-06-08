@extends('layouts.app')

@section('title', $product->name)

@push('styles')
<style>
.star-rating { display:flex; flex-direction:row-reverse; gap:4px; }
.star-rating input { display:none; }
.star-rating label { font-size:1.8rem; color:#ddd; cursor:pointer; }
.star-rating input:checked ~ label,
.star-rating label:hover,
.star-rating label:hover ~ label { color:#ffc107; }
.review-stars i { color:#ffc107; font-size:.9rem; }
.review-stars i.empty { color:#ddd; }
</style>
@endpush

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
            <h1 class="mt-1 mb-2" style="font-size:1.8rem;font-weight:700;">{{ $product->name }}</h1>

            {{-- Ortalama Puan --}}
            @php $avgRating = $product->average_rating; $reviewCount = $product->reviews->count(); @endphp
            <div class="d-flex align-items-center gap-2 mb-3">
                <div class="review-stars">
                    @for($s = 1; $s <= 5; $s++)
                        <i class="fas fa-star {{ $s <= round($avgRating) ? '' : 'empty' }}"></i>
                    @endfor
                </div>
                <span class="fw-bold">{{ $avgRating > 0 ? $avgRating : '-' }}</span>
                <span class="text-muted small">({{ $reviewCount }} değerlendirme)</span>
            </div>

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
            <p class="text-muted mb-3">{{ $product->description }}</p>
            @endif

            <div class="mb-3">
                @if($product->stock > 10)
                    <span class="badge bg-success"><i class="fas fa-check me-1"></i>Stokta Var ({{ $product->stock }} adet)</span>
                @elseif($product->stock > 0)
                    <span class="badge bg-warning text-dark"><i class="fas fa-exclamation me-1"></i>Son {{ $product->stock }} ürün!</span>
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

    {{-- Değerlendirmeler --}}
    <div class="row mt-5">
        <div class="col-md-8">
            <h4 class="section-title">Müşteri Değerlendirmeleri</h4>

            @if($product->reviews->count())
            <div class="d-flex gap-3 mb-4 p-3 bg-white rounded-3 shadow-sm align-items-center">
                <div class="text-center">
                    <div style="font-size:3rem;font-weight:700;color:#e94560;line-height:1;">{{ number_format($avgRating,1) }}</div>
                    <div class="review-stars my-1">
                        @for($s=1;$s<=5;$s++)<i class="fas fa-star {{ $s<=round($avgRating)?'':'empty' }}"></i>@endfor
                    </div>
                    <small class="text-muted">{{ $reviewCount }} değerlendirme</small>
                </div>
                <div class="flex-grow-1">
                    @for($star=5; $star>=1; $star--)
                    @php $cnt = $product->reviews->where('rating',$star)->count(); $pct = $reviewCount ? round($cnt/$reviewCount*100) : 0; @endphp
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <small class="text-muted" style="width:20px;">{{ $star }}</small>
                        <i class="fas fa-star" style="color:#ffc107;font-size:.75rem;"></i>
                        <div class="progress flex-grow-1" style="height:8px;">
                            <div class="progress-bar" style="width:{{ $pct }}%;background:#ffc107;"></div>
                        </div>
                        <small class="text-muted" style="width:25px;">{{ $cnt }}</small>
                    </div>
                    @endfor
                </div>
            </div>

            @foreach($product->reviews()->with('user')->latest()->get() as $review)
            <div class="card border-0 shadow-sm mb-3 p-3">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <strong>{{ $review->user->name }}</strong>
                        <div class="review-stars mt-1">
                            @for($s=1;$s<=5;$s++)<i class="fas fa-star {{ $s<=$review->rating?'':'empty' }}"></i>@endfor
                        </div>
                    </div>
                    <small class="text-muted">{{ $review->created_at->format('d.m.Y') }}</small>
                </div>
                @if($review->comment)
                <p class="mb-0 mt-2 text-muted">{{ $review->comment }}</p>
                @endif
            </div>
            @endforeach
            @else
            <div class="text-center py-4 text-muted">
                <i class="fas fa-star fa-2x mb-2"></i>
                <p>Henüz değerlendirme yok. İlk değerlendiren siz olun!</p>
            </div>
            @endif
        </div>

        <div class="col-md-4">
            @auth
            <div class="card border-0 shadow-sm p-3">
                <h6 class="fw-bold mb-3">Değerlendirme Yaz</h6>
                <form method="POST" action="{{ route('reviews.store', $product->slug) }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Puanınız</label>
                        <div class="star-rating">
                            @for($s=5;$s>=1;$s--)
                            <input type="radio" name="rating" id="star{{ $s }}" value="{{ $s }}" {{ old('rating')==$s?'checked':'' }}>
                            <label for="star{{ $s }}"><i class="fas fa-star"></i></label>
                            @endfor
                        </div>
                        @error('rating')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Yorumunuz</label>
                        <textarea name="comment" class="form-control" rows="3" placeholder="Ürün hakkında düşünceleriniz...">{{ old('comment') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-danger w-100 rounded-pill">
                        <i class="fas fa-paper-plane me-2"></i>Gönder
                    </button>
                </form>
            </div>
            @else
            <div class="card border-0 shadow-sm p-3 text-center">
                <i class="fas fa-lock fa-2x text-muted mb-2"></i>
                <p class="text-muted small mb-2">Değerlendirme yapmak için giriş yapın.</p>
                <a href="{{ route('login') }}" class="btn btn-danger btn-sm rounded-pill">Giriş Yap</a>
            </div>
            @endauth
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
