@extends('layouts.app')

@section('title', 'Ürünler')

@section('content')
<div class="container my-4">
    <div class="row">
        {{-- Sidebar --}}
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm p-3">
                <h6 class="fw-bold mb-3">Kategoriler</h6>
                <ul class="list-unstyled mb-0">
                    <li class="mb-1">
                        <a href="{{ route('products.index') }}" class="text-decoration-none {{ !request('category') ? 'fw-bold text-danger' : 'text-dark' }}">
                            Tümü
                        </a>
                    </li>
                    @foreach($categories as $cat)
                    <li class="mb-1">
                        <a href="{{ route('products.index', ['category' => $cat->slug]) }}"
                           class="text-decoration-none {{ request('category') === $cat->slug ? 'fw-bold text-danger' : 'text-dark' }}">
                            {{ $cat->name }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- Products --}}
        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <p class="text-muted mb-0">{{ $products->total() }} ürün bulundu</p>
                <form method="GET" class="d-flex gap-2">
                    @if(request('category'))<input type="hidden" name="category" value="{{ request('category') }}">@endif
                    @if(request('search'))<input type="hidden" name="search" value="{{ request('search') }}">@endif
                    <select name="sort" class="form-select form-select-sm" onchange="this.form.submit()" style="width:auto;">
                        <option value="">Sırala</option>
                        <option value="price_asc"  {{ request('sort') == 'price_asc'  ? 'selected' : '' }}>Fiyat: Düşük → Yüksek</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Fiyat: Yüksek → Düşük</option>
                    </select>
                </form>
            </div>

            @if($products->count())
            <div class="row g-3">
                @foreach($products as $product)
                    @include('frontend._product_card', compact('product'))
                @endforeach
            </div>
            <div class="mt-4">{{ $products->links() }}</div>
            @else
            <div class="text-center py-5">
                <i class="fas fa-search fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Ürün bulunamadı.</h5>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
