@extends('layouts.app')

@section('title', 'Sipariş ' . $order->order_number)

@section('content')
<div class="container my-5" style="max-width:860px;">
    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('orders.index') }}" style="color:#888;text-decoration:none;font-size:.9rem;"><i class="fas fa-arrow-left me-1"></i>Siparişlerim</a>
        <span style="color:#ddd;">/</span>
        <span style="font-weight:700;color:#111;">{{ $order->order_number }}</span>
        <span class="badge bg-{{ $order->status_badge }} ms-1">{{ $order->status_label }}</span>
    </div>

    <div class="row g-4">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">Sipariş Ürünleri</h6>
                    @foreach($order->items as $item)
                    <div class="d-flex align-items-center gap-3 py-2 {{ !$loop->last ? 'border-bottom' : '' }}">
                        @if($item->product && $item->product->image)
                            <img src="{{ asset($item->product->image) }}" width="60" height="60" style="object-fit:cover;border-radius:8px;border:1px solid #eee;">
                        @else
                            <div style="width:60px;height:60px;background:#f5f5f5;border-radius:8px;display:flex;align-items:center;justify-content:center;"><i class="fas fa-image text-muted"></i></div>
                        @endif
                        <div class="flex-grow-1">
                            <div style="font-weight:600;font-size:.9rem;">{{ $item->product->name ?? 'Ürün silinmiş' }}</div>
                            <div style="font-size:.8rem;color:#888;">Adet: {{ $item->quantity }}</div>
                        </div>
                        <div style="font-weight:700;color:#e94560;">{{ number_format($item->quantity * $item->price, 2) }} ₺</div>
                    </div>
                    @endforeach
                    <div class="d-flex justify-content-between mt-3 pt-2 border-top">
                        <strong>Toplam</strong>
                        <strong style="color:#e94560;font-size:1.1rem;">{{ number_format($order->total_price, 2) }} ₺</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">Teslimat Bilgileri</h6>
                    <p class="mb-1 small"><i class="fas fa-user me-2 text-muted"></i>{{ $order->name }}</p>
                    <p class="mb-1 small"><i class="fas fa-phone me-2 text-muted"></i>{{ $order->phone }}</p>
                    <p class="mb-1 small"><i class="fas fa-map-marker-alt me-2 text-muted"></i>{{ $order->address }}, {{ $order->city }}</p>
                    @if($order->note)
                    <p class="mb-0 small"><i class="fas fa-sticky-note me-2 text-muted"></i>{{ $order->note }}</p>
                    @endif
                </div>
            </div>
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">Ödeme Bilgileri</h6>
                    <p class="mb-1 small"><i class="fas fa-credit-card me-2 text-muted"></i>{{ $order->payment_method_label }}</p>
                    <p class="mb-0 small text-muted"><i class="fas fa-calendar me-2"></i>{{ $order->created_at->format('d.m.Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
