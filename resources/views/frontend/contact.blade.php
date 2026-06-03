@extends('layouts.app')

@section('title', 'İletişim')

@section('content')
<div class="container my-5" style="max-width:800px;">
    <h2 class="section-title">İletişim</h2>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 text-center p-3">
                <i class="fas fa-map-marker-alt fa-2x mb-3" style="color:#e94560;"></i>
                <h6 class="fw-bold">Adres</h6>
                <p class="text-muted small mb-0">İstanbul, Türkiye</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 text-center p-3">
                <i class="fas fa-phone fa-2x mb-3" style="color:#e94560;"></i>
                <h6 class="fw-bold">Telefon</h6>
                <p class="text-muted small mb-0">+90 212 000 00 00</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 text-center p-3">
                <i class="fas fa-envelope fa-2x mb-3" style="color:#e94560;"></i>
                <h6 class="fw-bold">E-posta</h6>
                <p class="text-muted small mb-0">info@pikselpazar.com</p>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mt-4">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-4">Bize Yazın</h5>
            <form method="POST" action="{{ route('contact.store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Adınız <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">E-posta <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Konu <span class="text-danger">*</span></label>
                    <input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror" value="{{ old('subject') }}">
                    @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-4">
                    <label class="form-label fw-semibold">Mesaj <span class="text-danger">*</span></label>
                    <textarea name="message" class="form-control @error('message') is-invalid @enderror" rows="5">{{ old('message') }}</textarea>
                    @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <button type="submit" class="btn btn-danger px-5 rounded-pill fw-bold">
                    <i class="fas fa-paper-plane me-2"></i>Gönder
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
