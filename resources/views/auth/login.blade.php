@extends('layouts.app')

@section('title', 'Giriş Yap')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold">Giriş Yap</h3>
                        <p class="text-muted small">Hesabınıza giriş yapın</p>
                    </div>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>{{ $errors->first() }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold">E-posta</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}" placeholder="ornek@mail.com" autofocus>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Şifre</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••">
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-4 d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label small" for="remember">Beni Hatırla</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-danger w-100 py-2 fw-bold rounded-pill">
                            Giriş Yap
                        </button>
                    </form>
                    <hr>
                    <div class="text-center">
                        <small class="text-muted">Hesabınız yok mu?
                            <a href="{{ route('register') }}" class="text-danger fw-semibold">Kayıt Ol</a>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
