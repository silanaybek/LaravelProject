@extends('layouts.app')

@section('title', 'Siparişlerim')

@section('content')
<div class="container my-5" style="max-width:860px;">
    <h4 style="font-weight:800;margin-bottom:24px;">Siparişlerim</h4>

    @if($orders->isEmpty())
    <div class="text-center py-5">
        <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
        <p class="text-muted">Henüz siparişiniz bulunmuyor.</p>
        <a href="{{ route('products.index') }}" class="btn btn-danger px-4 fw-bold">Alışverişe Başla</a>
    </div>
    @else
    <div class="d-flex flex-column gap-3">
        @foreach($orders as $order)
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                <div class="d-flex align-items-center gap-3">
                    <div>
                        <div style="font-size:.75rem;color:#888;">Sipariş No</div>
                        <div style="font-weight:700;color:#111;">{{ $order->order_number }}</div>
                    </div>
                    <div>
                        <div style="font-size:.75rem;color:#888;">Tarih</div>
                        <div style="font-weight:600;font-size:.9rem;">{{ $order->created_at->format('d.m.Y') }}</div>
                    </div>
                    <div>
                        <div style="font-size:.75rem;color:#888;">Toplam</div>
                        <div style="font-weight:700;color:#e94560;">{{ number_format($order->total_price, 2) }} ₺</div>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-{{ $order->status_badge }} px-3 py-2">{{ $order->status_label }}</span>
                    <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-outline-secondary">Detay</a>
                </div>
            </div>
            <div class="card-body py-3">
                <div class="d-flex gap-3 flex-wrap">
                    @foreach($order->items->take(4) as $item)
                    <div class="d-flex align-items-center gap-2">
                        @if($item->product && $item->product->image)
                            <img src="{{ asset($item->product->image) }}" width="48" height="48" style="object-fit:cover;border-radius:6px;border:1px solid #eee;">
                        @endif
                        <div>
                            <div style="font-size:.82rem;font-weight:600;max-width:140px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $item->product->name ?? 'Ürün silinmiş' }}</div>
                            <div style="font-size:.75rem;color:#888;">x{{ $item->quantity }} — {{ number_format($item->price, 2) }} ₺</div>
                        </div>
                    </div>
                    @endforeach
                    @if($order->items->count() > 4)
                    <div style="font-size:.8rem;color:#888;align-self:center;">+{{ $order->items->count() - 4 }} ürün daha</div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
