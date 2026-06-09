@extends('layouts.app')

@section('title', 'Sepetim')

@section('content')
<div class="container my-4">
    <h2 class="section-title">Sepetim</h2>

    @if($items->isEmpty())
    <div class="text-center py-5">
        <i class="fas fa-shopping-cart fa-4x text-muted mb-3"></i>
        <h5 class="text-muted">Sepetiniz boş.</h5>
        <a href="{{ route('products.index') }}" class="btn btn-danger mt-3 px-4 rounded-pill">Alışverişe Başla</a>
    </div>
    @else
    <div class="row">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Ürün</th><th>Fiyat</th><th>Adet</th><th>Toplam</th><th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        @if($item->product->image)
                                            <img src="{{ asset('storage/'.$item->product->image) }}" width="60" height="60" style="object-fit:cover;border-radius:8px;">
                                        @endif
                                        <div>
                                            <a href="{{ route('products.show', $item->product->slug) }}" class="text-decoration-none text-dark fw-semibold">
                                                {{ $item->product->name }}
                                            </a>
                                            @if($item->size)
                                            <div class="small text-muted">Beden: <span class="badge bg-secondary">{{ $item->size }}</span></div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>{{ number_format($item->product->discount_price ?? $item->product->price, 2) }} ₺</td>
                                <td>
                                    <form method="POST" action="{{ route('cart.update', $item) }}" class="d-flex align-items-center gap-2">
                                        @csrf @method('PATCH')
                                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control form-control-sm" style="width:70px;">
                                        <button type="submit" class="btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-sync-alt"></i>
                                        </button>
                                    </form>
                                </td>
                                <td><strong>{{ number_format($item->quantity * ($item->product->discount_price ?? $item->product->price), 2) }} ₺</strong></td>
                                <td>
                                    <form method="POST" action="{{ route('cart.remove', $item) }}">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <form method="POST" action="{{ route('cart.clear') }}" class="mt-2">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-outline-secondary btn-sm" onclick="return confirm('Sepeti temizlemek istediğinize emin misiniz?')">
                    <i class="fas fa-trash me-1"></i>Sepeti Temizle
                </button>
            </form>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-4">Sipariş Özeti</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Ara Toplam</span>
                        <span>{{ number_format($total, 2) }} ₺</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Kargo</span>
                        <span class="text-success">Ücretsiz</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-4">
                        <strong>Toplam</strong>
                        <strong style="color:#e94560;font-size:1.3rem;">{{ number_format($total, 2) }} ₺</strong>
                    </div>
                    <a href="{{ route('checkout.index') }}" class="btn btn-danger w-100 py-2 fw-bold rounded-pill">
                        Siparişi Tamamla <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary w-100 mt-2 btn-sm">
                        Alışverişe Devam Et
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
