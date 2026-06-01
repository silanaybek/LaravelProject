@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('breadcrumb', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box" style="background:#e94560; color:#fff;">
            <div class="inner"><h3>{{ $stats['new_orders'] }}</h3><p>Yeni Sipariş</p></div>
            <div class="icon"><i class="fas fa-shopping-bag"></i></div>
            <a href="{{ route('admin.orders.index') }}?status=new" class="small-box-footer">Görüntüle <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner"><h3>{{ $stats['total_orders'] }}</h3><p>Toplam Sipariş</p></div>
            <div class="icon"><i class="fas fa-list-alt"></i></div>
            <a href="{{ route('admin.orders.index') }}" class="small-box-footer">Görüntüle <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner"><h3>{{ $stats['total_products'] }}</h3><p>Ürünler</p></div>
            <div class="icon"><i class="fas fa-box-open"></i></div>
            <a href="{{ route('admin.products.index') }}" class="small-box-footer">Görüntüle <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner"><h3>{{ $stats['total_users'] }}</h3><p>Kullanıcılar</p></div>
            <div class="icon"><i class="fas fa-users"></i></div>
            <a href="{{ route('admin.users.index') }}" class="small-box-footer">Görüntüle <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center py-4">
                <h2 class="text-success font-weight-bold">{{ number_format($stats['total_revenue'], 2) }} ₺</h2>
                <p class="text-muted mb-0">Toplam Gelir (Tamamlanan)</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center py-4">
                <h2 class="font-weight-bold" style="color:#e94560;">{{ $stats['total_categories'] }}</h2>
                <p class="text-muted mb-0">Kategori</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center py-4">
                <h2 class="text-info font-weight-bold">{{ $stats['total_orders'] }}</h2>
                <p class="text-muted mb-0">Toplam Sipariş</p>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-clock mr-2"></i>Son Siparişler</h5>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-primary">Tümünü Gör</a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="thead-light">
                <tr>
                    <th>Sipariş No</th><th>Müşteri</th><th>Tutar</th><th>Durum</th><th>Tarih</th><th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentOrders as $order)
                <tr>
                    <td><strong>{{ $order->order_number }}</strong></td>
                    <td>{{ $order->name }}</td>
                    <td>{{ number_format($order->total_price, 2) }} ₺</td>
                    <td><span class="badge badge-{{ $order->status_badge }}">{{ $order->status_label }}</span></td>
                    <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                    <td><a href="{{ route('admin.orders.show', $order) }}" class="btn btn-xs btn-info">Detay</a></td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-4 text-muted">Sipariş bulunamadı.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
