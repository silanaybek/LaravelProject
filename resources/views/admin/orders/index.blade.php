@extends('layouts.admin')

@section('title', 'Siparişler')
@section('page-title', 'Siparişler')
@section('breadcrumb', 'Siparişler')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col"><h5 class="mb-0">Sipariş Listesi</h5></div>
            <div class="col-auto">
                <form method="GET" class="d-flex">
                    <select name="status" class="form-control form-control-sm mr-2" onchange="this.form.submit()">
                        <option value="all" {{ request('status','all') == 'all' ? 'selected' : '' }}>Tüm Siparişler</option>
                        <option value="new"        {{ request('status') == 'new'        ? 'selected' : '' }}>Yeni</option>
                        <option value="accepted"   {{ request('status') == 'accepted'   ? 'selected' : '' }}>Onaylandı</option>
                        <option value="onshipping" {{ request('status') == 'onshipping' ? 'selected' : '' }}>Kargoda</option>
                        <option value="completed"  {{ request('status') == 'completed'  ? 'selected' : '' }}>Tamamlandı</option>
                        <option value="cancelled"  {{ request('status') == 'cancelled'  ? 'selected' : '' }}>İptal</option>
                    </select>
                    <button class="btn btn-sm btn-primary">Filtrele</button>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="thead-light">
                <tr>
                    <th>Sipariş No</th><th>Müşteri</th><th>Telefon</th><th>Tutar</th><th>Durum</th><th>Tarih</th><th>İşlem</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td><strong>{{ $order->order_number }}</strong></td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->phone }}</td>
                    <td><strong>{{ number_format($order->total_price, 2) }} ₺</strong></td>
                    <td><span class="badge badge-{{ $order->status_badge }}">{{ $order->status_label }}</span></td>
                    <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-xs btn-info mr-1">
                            <i class="fas fa-eye"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.orders.destroy', $order) }}" class="d-inline" onsubmit="return confirm('Siparişi silmek istediğinize emin misiniz?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-4 text-muted">Sipariş bulunamadı.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($orders->hasPages())
    <div class="card-footer">{{ $orders->links() }}</div>
    @endif
</div>
@endsection
