@extends('layouts.app')

@section('title', 'Giriş Yap')

@section('content')
<div style="background:#f3f3f3;min-height:calc(100vh - 120px);display:flex;align-items:center;justify-content:center;padding:40px 16px;">
    <div style="width:100%;max-width:380px;">

        <div class="text-center mb-3">
            <a href="{{ route('home') }}" style="text-decoration:none;">
                <span style="font-size:2rem;font-weight:800;color:#e94560;letter-spacing:-1px;">Piksel<span style="color:#222;">Pazar</span></span>
            </a>
        </div>

        <div style="background:#fff;border:1px solid #d5d9d9;border-radius:8px;padding:28px 28px 22px;">
            <h4 style="font-weight:700;margin-bottom:20px;color:#111;font-size:1.35rem;">Giriş yapın</h4>

            @if ($errors->any())
            <div class="alert alert-danger py-2 small">
                <i class="fas fa-exclamation-circle me-1"></i>{{ $errors->first() }}
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size:.875rem;color:#111;">E-posta</label>
                    <input type="email" name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           style="border-color:#888;border-radius:4px;font-size:.9rem;"
                           value="{{ old('email') }}" autofocus>
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-2">
                    <label class="form-label fw-semibold" style="font-size:.875rem;color:#111;">Şifre</label>
                    <input type="password" name="password"
                           class="form-control @error('password') is-invalid @enderror"
                           style="border-color:#888;border-radius:4px;font-size:.9rem;">
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember" style="font-size:.85rem;">Beni hatırla</label>
                    </div>
                </div>
                <button type="submit"
                        style="width:100%;background:linear-gradient(to bottom,#f7dfa5,#f0c14b);border:1px solid #a88734;border-radius:4px;padding:8px;font-size:.9rem;font-weight:600;color:#111;cursor:pointer;">
                    Giriş Yap
                </button>
            </form>

            <div style="margin:18px 0 10px;display:flex;align-items:center;gap:10px;">
                <div style="flex:1;height:1px;background:#e7e7e7;"></div>
                <span style="font-size:.75rem;color:#767676;">Yeni misiniz?</span>
                <div style="flex:1;height:1px;background:#e7e7e7;"></div>
            </div>

            <a href="{{ route('register') }}"
               style="display:block;text-align:center;width:100%;background:linear-gradient(to bottom,#f4f4f4,#e8e8e8);border:1px solid #adb1b8;border-radius:4px;padding:8px;font-size:.875rem;color:#111;text-decoration:none;font-weight:500;">
                Hesap oluşturun
            </a>
        </div>

        <div style="margin-top:18px;text-align:center;">
            <span style="font-size:.72rem;color:#767676;">
                Giriş yaparak
                <a href="#" style="color:#0066c0;text-decoration:none;">Kullanım Koşulları</a>'nı
                kabul etmiş olursunuz.
            </span>
        </div>
    </div>
</div>
@endsection
