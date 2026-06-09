@extends('layouts.app')

@section('title', 'Hesap Oluştur')

@section('content')
<div style="background:#f3f3f3;min-height:calc(100vh - 120px);display:flex;align-items:center;justify-content:center;padding:40px 16px;">
    <div style="width:100%;max-width:400px;">

        <div class="text-center mb-3">
            <a href="{{ route('home') }}" style="text-decoration:none;">
                <span style="font-size:2rem;font-weight:800;color:#e94560;letter-spacing:-1px;">Piksel<span style="color:#222;">Pazar</span></span>
            </a>
        </div>

        <div style="background:#fff;border:1px solid #d5d9d9;border-radius:8px;padding:28px 28px 22px;">
            <h4 style="font-weight:700;margin-bottom:4px;color:#111;font-size:1.35rem;">Hesap oluşturun</h4>
            <p style="font-size:.85rem;color:#444;margin-bottom:20px;">PikselPazar'a hoş geldiniz.</p>

            @if ($errors->any())
            <div class="alert alert-danger py-2 small">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size:.875rem;color:#111;">Ad Soyad</label>
                    <input type="text" name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           style="border-color:#888;border-radius:4px;font-size:.9rem;"
                           value="{{ old('name') }}" autofocus>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size:.875rem;color:#111;">E-posta</label>
                    <input type="email" name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           style="border-color:#888;border-radius:4px;font-size:.9rem;"
                           value="{{ old('email') }}">
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size:.875rem;color:#111;">Telefon <span style="font-size:.78rem;color:#767676;font-weight:400;">(isteğe bağlı)</span></label>
                    <input type="text" name="phone"
                           class="form-control"
                           style="border-color:#888;border-radius:4px;font-size:.9rem;"
                           value="{{ old('phone') }}" placeholder="05xx xxx xx xx">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size:.875rem;color:#111;">Şifre</label>
                    <input type="password" name="password"
                           class="form-control @error('password') is-invalid @enderror"
                           style="border-color:#888;border-radius:4px;font-size:.9rem;">
                    <div style="font-size:.75rem;color:#767676;margin-top:4px;">En az 6 karakter olmalıdır.</div>
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-4">
                    <label class="form-label fw-semibold" style="font-size:.875rem;color:#111;">Şifreyi tekrar girin</label>
                    <input type="password" name="password_confirmation"
                           class="form-control"
                           style="border-color:#888;border-radius:4px;font-size:.9rem;">
                </div>
                <button type="submit"
                        style="width:100%;background:linear-gradient(to bottom,#f7dfa5,#f0c14b);border:1px solid #a88734;border-radius:4px;padding:8px;font-size:.9rem;font-weight:600;color:#111;cursor:pointer;">
                    Kayıt Ol
                </button>

                <p style="font-size:.72rem;color:#767676;margin-top:12px;line-height:1.5;">
                    Kayıt olarak
                    <a href="#" style="color:#0066c0;text-decoration:none;">Kullanım Koşulları</a> ve
                    <a href="#" style="color:#0066c0;text-decoration:none;">Gizlilik Politikası</a>'nı
                    kabul etmiş olursunuz.
                </p>
            </form>

            <div style="margin-top:14px;padding-top:14px;border-top:1px solid #e7e7e7;text-align:center;">
                <span style="font-size:.85rem;color:#444;">Zaten hesabınız var mı?
                    <a href="{{ route('login') }}" style="color:#0066c0;text-decoration:none;font-weight:500;">Giriş yapın</a>
                </span>
            </div>
        </div>
    </div>
</div>
@endsection
