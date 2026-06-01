@extends('layouts.admin')

@section('title', 'Sipariş Detayı')
@section('page-title', 'Sipariş Detayı')
@section('breadcrumb', $order->order_number)

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="mb-0">{{ $order->order_number }}</h5>
                <span class="badge badge-{{ $order->status_badge }} px-3 py-2">{{ $order->status_label }}</span>
            </div>
            <div class="card-body p-0">
                <table class="table mb-0">
                    <thead class="thead-light">
                        <tr><th>Ürün</th><th>Adet</th><th>Birim Fiyat</th><th>Toplam</th></tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>
                                @if($item->product && $item->product->image)
                                    <img src="{{ asset('storage/'.$item->product->image) }}" width="40" height="40" style="object-fit:cover;border-radius:4px;margin-right:8px;">
                                @endif
                                {{ $item->product->name ?? 'Ürün Silinmiş' }}
                            </td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->price, 2) }} ₺</td>
                            <td><strong>{{ number_format($item->quantity * $item->price, 2) }} ₺</strong></td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-right font-weight-bold">Genel Toplam:</td>
                            <td><strong class="text-success" style="font-size:1.1rem;">{{ number_format($order->total_price, 2) }} ₺</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><h6 class="mb-0">Müşteri Bilgileri</h6></div>
            <div class="card-body">
                <p class="mb-1"><i class="fas fa-user mr-2 text-muted"></i><strong>{{ $order->name }}</strong></p>
                <p class="mb-1"><i class="fas fa-phone mr-2 text-muted"></i>{{ $order->phone }}</p>
                <p class="mb-1"><i class="fas fa-map-marker-alt mr-2 text-muted"></i>{{ $order->address }}, {{ $order->city }}</p>
                @if($order->note)
                <p class="mb-1"><i class="fas fa-sticky-note mr-2 text-muted"></i>{{ $order->note }}</p>
                @endif
                <hr>
                <p class="mb-0 text-muted"><small>Kayıt: {{ $order->user->email ?? '-' }}</small></p>
                <p class="mb-0 text-muted"><small>Tarih: {{ $order->created_at->format('d.m.Y H:i') }}</small></p>
            </div>
        </div>
        <div class="card">
            <div class="card-header"><h6 class="mb-0">Durum Güncelle</h6></div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.orders.updateStatus', $order) }}">
                    @csrf @method('PATCH')
                    <div class="form-group">
                        <select name="status" class="form-control">
                            <option value="new"        {{ $order->status == 'new'        ? 'selected' : '' }}>Yeni</option>
                            <option value="accepted"   {{ $order->status == 'accepted'   ? 'selected' : '' }}>Onaylandı</option>
                            <option value="onshipping" {{ $order->status == 'onshipping' ? 'selected' : '' }}>Kargoda</option>
                            <option value="completed"  {{ $order->status == 'completed'  ? 'selected' : '' }}>Tamamlandı</option>
                            <option value="cancelled"  {{ $order->status == 'cancelled'  ? 'selected' : '' }}>İptal</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Güncelle</button>
                </form>
            </div>
        </div>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-block">
            <i class="fas fa-arrow-left mr-2"></i>Geri Dön
        </a>
    </div>
</div>
@endsection
