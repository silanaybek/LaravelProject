<div class="col-6 col-md-4 col-lg-3">
    <div class="card product-card h-100">
        <div class="position-relative">
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" class="card-img-top" alt="{{ $product->name }}">
            @else
                <div style="height:220px;background:linear-gradient(135deg,#f8f9fa,#e9ecef);display:flex;align-items:center;justify-content:center;">
                    <i class="fas fa-image fa-3x text-muted"></i>
                </div>
            @endif
            @if($product->discount_price)
                <span class="badge badge-discount text-white">
                    -%{{ round((($product->price - $product->discount_price) / $product->price) * 100) }}
                </span>
            @endif
            @if($product->featured)
                <span class="badge badge-featured">Öne Çıkan</span>
            @endif
        </div>
        <div class="card-body d-flex flex-column p-3">
            <a href="{{ route('products.show', $product->slug) }}" class="text-decoration-none text-dark">
                <small class="text-muted">{{ $product->category->name ?? '' }}</small>
                <h6 class="mb-1 mt-1" style="font-size:.9rem;font-weight:600;">{{ $product->name }}</h6>
            </a>
            @php $avg = $product->reviews()->avg('rating'); $cnt = $product->reviews()->count(); @endphp
            @if($cnt > 0)
            <div class="d-flex align-items-center gap-1 mb-1">
                @for($s=1;$s<=5;$s++)
                    <i class="fas fa-star" style="font-size:.65rem;color:{{ $s<=round($avg)?'#ffc107':'#ddd' }};"></i>
                @endfor
                <span style="font-size:.72rem;color:#888;">({{ $cnt }})</span>
            </div>
            @endif
            <div class="mt-auto">
                <div class="mb-2">
                    @if($product->discount_price)
                        <span class="price">{{ number_format($product->discount_price, 2) }} ₺</span>
                        <span class="price-old ms-2">{{ number_format($product->price, 2) }} ₺</span>
                    @else
                        <span class="price">{{ number_format($product->price, 2) }} ₺</span>
                    @endif
                </div>
                @if($product->stock > 0)
                    <form method="POST" action="{{ route('cart.add') }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="btn-add-cart">
                            <i class="fas fa-cart-plus me-1"></i>Sepete Ekle
                        </button>
                    </form>
                @else
                    <button class="btn-add-cart" disabled style="opacity:.5;cursor:not-allowed;">Stokta Yok</button>
                @endif
            </div>
        </div>
    </div>
</div>
