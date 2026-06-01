@extends('layouts.app')

@section('title', 'Sipariş Ver')

@section('content')
<div class="container my-4" style="max-width:900px;">
    <h2 class="section-title">Sipariş Ver</h2>
    <div class="row">
        <div class="col-md-7">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-4"><i class="fas fa-map-marker-alt me-2 text-danger"></i>Teslimat Bilgileri</h5>
                    <form method="POST" action="{{ route('checkout.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Ad Soyad <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name', auth()->user()->name) }}">
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Telefon <span class="text-danger">*</span></label>
                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                       value="{{ old('phone', auth()->user()->phone) }}" placeholder="05xx xxx xx xx">
                                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Adres <span class="text-danger">*</span></label>
                            <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="3"
                                      placeholder="Sokak, mahalle, bina no...">{{ old('address', auth()->user()->address) }}</textarea>
                            @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Şehir <span class="text-danger">*</span></label>
                            <input type="text" name="city" class="form-control @error('city') is-invalid @enderror"
                                   value="{{ old('city') }}" placeholder="İstanbul">
                            @error('city')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Sipariş Notu</label>
                            <textarea name="note" class="form-control" rows="2" placeholder="Opsiyonel not...">{{ old('note') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-danger w-100 py-2 fw-bold rounded-pill fs-5">
                            <i class="fas fa-check-circle me-2"></i>Siparişi Onayla
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Sipariş Özeti</h5>
                    @foreach($items as $item)
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex align-items-center gap-2">
                            @if($item->product->image)
                                <img src="{{ asset('storage/'.$item->product->image) }}" width="40" height="40" style="object-fit:cover;border-radius:6px;">
                            @endif
                            <div>
                                <small class="fw-semibold">{{ $item->product->name }}</small>
                                <div class="text-muted" style="font-size:.75rem;">x{{ $item->quantity }}</div>
                            </div>
                        </div>
                        <small>{{ number_format($item->quantity * ($item->product->discount_price ?? $item->product->price), 2) }} ₺</small>
                    </div>
                    @endforeach
                    <hr>
                    <div class="d-flex justify-content-between">
                        <strong>Toplam</strong>
                        <strong style="color:#e94560;font-size:1.2rem;">{{ number_format($total, 2) }} ₺</strong>
                    </div>
                    <div class="alert alert-success mt-3 mb-0 py-2 small">
                        <i class="fas fa-truck me-2"></i>Ücretsiz kargo!
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
