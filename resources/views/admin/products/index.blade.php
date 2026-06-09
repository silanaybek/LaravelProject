@extends('layouts.admin')

@section('title', 'Ürünler')
@section('page-title', 'Ürünler')
@section('breadcrumb', 'Ürünler')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Tüm Ürünler</h5>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus mr-1"></i> Yeni Ürün
        </a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="thead-light">
                <tr>
                    <th>#</th><th>Resim</th><th>Ürün Adı</th><th>Kategori</th><th>Fiyat</th><th>Stok</th><th>Durum</th><th>İşlem</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>
                        @if($product->image)
                            <img src="{{ asset($product->image) }}" width="45" height="45" style="object-fit:cover; border-radius:6px;">
                        @else
                            <div style="width:45px;height:45px;background:#eee;border-radius:6px;display:flex;align-items:center;justify-content:center;"><i class="fas fa-image text-muted"></i></div>
                        @endif
                    </td>
                    <td>
                        <strong>{{ $product->name }}</strong>
                        @if($product->featured)<span class="badge badge-warning ml-1">Öne Çıkan</span>@endif
                    </td>
                    <td>{{ $product->category->name ?? '-' }}</td>
                    <td>
                        @if($product->discount_price)
                            <span class="text-danger font-weight-bold">{{ number_format($product->discount_price, 2) }} ₺</span>
                            <small class="text-muted"><del>{{ number_format($product->price, 2) }} ₺</del></small>
                        @else
                            {{ number_format($product->price, 2) }} ₺
                        @endif
                    </td>
                    <td>
                        @if($product->stock > 10)
                            <span class="badge badge-success">{{ $product->stock }}</span>
                        @elseif($product->stock > 0)
                            <span class="badge badge-warning">{{ $product->stock }}</span>
                        @else
                            <span class="badge badge-danger">Tükendi</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge badge-{{ $product->status ? 'success' : 'secondary' }}">
                            {{ $product->status ? 'Aktif' : 'Pasif' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-xs btn-warning mr-1">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.products.destroy', $product) }}" class="d-inline" onsubmit="return confirm('Silmek istediğinize emin misiniz?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="text-center py-4 text-muted">Henüz ürün eklenmemiş.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($products->hasPages())
    <div class="card-footer">{{ $products->links() }}</div>
    @endif
</div>
@endsection
