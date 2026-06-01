@extends('layouts.admin')

@section('title', 'Kullanıcı Detayı')
@section('page-title', 'Kullanıcı Detayı')
@section('breadcrumb', $user->name)

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center py-4">
                <div style="width:80px;height:80px;background:#e94560;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 15px;">
                    <span style="color:#fff;font-size:2rem;font-weight:700;">{{ strtoupper(substr($user->name,0,1)) }}</span>
                </div>
                <h5>{{ $user->name }}</h5>
                <p class="text-muted mb-1">{{ $user->email }}</p>
                <p class="text-muted mb-0">{{ $user->phone ?? 'Telefon yok' }}</p>
                <hr>
                <small class="text-muted">Kayıt: {{ $user->created_at->format('d.m.Y') }}</small>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><h6 class="mb-0">Siparişleri ({{ $user->orders->count() }})</h6></div>
            <div class="card-body p-0">
                <table class="table mb-0">
                    <thead class="thead-light">
                        <tr><th>Sipariş No</th><th>Tutar</th><th>Durum</th><th>Tarih</th><th></th></tr>
                    </thead>
                    <tbody>
                        @forelse($user->orders as $order)
                        <tr>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ number_format($order->total_price, 2) }} ₺</td>
                            <td><span class="badge badge-{{ $order->status_badge }}">{{ $order->status_label }}</span></td>
                            <td>{{ $order->created_at->format('d.m.Y') }}</td>
                            <td><a href="{{ route('admin.orders.show', $order) }}" class="btn btn-xs btn-info">Detay</a></td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center py-3 text-muted">Sipariş bulunamadı.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left mr-2"></i>Geri Dön
        </a>
    </div>
</div>
@endsection
